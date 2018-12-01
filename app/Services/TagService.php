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