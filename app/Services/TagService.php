<?php

namespace App\Services;


use App\Models\NoteTag;
use App\Models\Tag;

/**
 * Class TagService
 * @package App\Services
 */
class TagService
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * @var NoteTag
     */
    private $noteTag;

    /**
     * TagService constructor.
     * @param Tag $tag
     * @param NoteTag $noteTag
     */
    public function __construct(Tag $tag, NoteTag $noteTag)
    {
        $this->tag = $tag;
        $this->noteTag = $noteTag;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->tag->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function index(int $id)
    {
        $tag = $this->tag->where('id', $id)->with('notes')->first();
        $notes = $tag->notes;
        return $notes;
    }

    /**
     * @param array $data
     * @param int $idNote
     */
    public function updateTags(array $data, int $idNote)
    {
        $oldTags = $this->noteTag->where('note_id',$idNote)->get();
        $oldTagArray = [];
        foreach ($oldTags as $oldTag) {
            in_array($oldTag->tag_id,$data)
                ? $oldTagArray[] = $oldTag->tag_id
                : $oldTag->delete();
        }
        $diff = array_diff($data, $oldTagArray);
        foreach ($diff as $idTag) {
            $noteTag = $this->getNewNoteTag();
            $noteTag->fill(['note_id' => $idNote, 'tag_id' => $idTag])->save();
        }
    }

    /**
     * @param string $name
     */
    public function store(string $name)
    {
        $tag = $this->getNewTag();
        $tag->fill(['name' => $name])->save();
    }

    /**
     * @return array
     */
    public function cloud()
    {
        $cloud = $this->getItemsArray();

        return $cloud;
    }

    /**
     * @return array
     */
    private function getItemsArray():array
    {
        $tags = $this->tag->with('notes')->get();
        $cloud = [];
        foreach ($tags as $tag) {
            $item['name'] = $tag->name;
            $item['id'] = $tag->id;
            $item['count'] = $tag->notes->count();
            $cloud[] = $item;
        }
        $cloud = $this->addRankIntoArray($cloud);

        return $cloud;
    }

    /**
     * @param array $data
     * @return array
     */
    private function addRankIntoArray(array $data)
    {
        array_multisort (array_column($data, 'count'), SORT_DESC, $data);
        $count = count($data);
        $rank = 1;
        $prevCount = $data[0]['count'];
        $data[0]['rank'] = $rank;
        for ($i = 1; $i < $count; $i++) {
            if ($data[$i]['count'] < $prevCount && $rank < 6) {
                $rank++;
            }
            $data[$i]['rank'] = $rank;
            $prevCount = $data[$i]['count'];
        }

        return $data;
    }

    /**
     * @return NoteTag
     */
    private function getNewNoteTag()
    {
        return new NoteTag();
    }

    /**
     * @return Tag
     */
    private function getNewTag()
    {
        return new Tag();
    }
}