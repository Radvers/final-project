<?php

namespace App\Services;


use App\Models\Note;
use App\Services\Auth\AuthInterface;

/**
 * Class NoteService
 * @package App\Services
 */
class NoteService
{
    /**
     * @var Note
     */
    private $note;

    /**
     * @var AuthInterface
     */
    private $auth;

    /**
     * NoteService constructor.
     * @param Note $note
     * @param AuthInterface $auth
     */
    public function __construct(Note $note, AuthInterface $auth)
    {
        $this->note = $note;
        $this->auth = $auth;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->note->ByField('id', $id)->first();
    }

    /**
     * @return mixed
     */
    public function getAllUserNotes()
    {
        return $this->note->ByField('user_id', $this->auth->getUser()->id)->get();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->note->ByField('id', $id)->delete();
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        $src = $this->storeFile($data);
        $data = $this->fillArray($data);
        //$this->note->ByField('id', $data['id'])->update($data);
        $note = $this->note->where('id',$data['id'])->first();
        $note->fill($data);
        $note->save();
        if ($src !== 'empty') {
            $note->file()->create(['src' => $src]);
        }
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        $note = $this->getNewNote();
        $data = $this->fillArray($data);
        $note->fill($data);
        $note->save();
    }

    private function storeFile(array $data):string
    {
        if (array_key_exists('file', $data)) {
            $file = $data['file'];
            $path = storage_path('files') . '\\' . $data['id'] . '\\';
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $name);
            return $path . $name;
        }
        return 'empty';
    }

    /**
     * @param array $data
     * @return array
     */
    private function fillArray(array $data)
    {
        $data['user_id'] = $this->auth->getUser()->id;
        $data['share'] = array_key_exists('share', $data) ? 1 : 0;

        return $data;
    }

    /**
     * @return Note
     */
    private function getNewNote()
    {
        return New Note();
    }

}