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
     * @var FileService
     */
    private $fileService;

    /**
     * NoteService constructor.
     * @param Note $note
     * @param AuthInterface $auth
     * @param FileService $fileService
     */
    public function __construct(Note $note, AuthInterface $auth, FileService $fileService)
    {
        $this->note = $note;
        $this->auth = $auth;
        $this->fileService = $fileService;
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
        $note = $this->note->ByField('id', $id)->first();
        if ($note->file){
            $this->fileService->deleteFile($note->file->src);
        }
        $note->delete();
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        $src = $this->fileService->store($data);
        $data = $this->fillArray($data);
        $note = $this->note->where('id',$data['id'])->first();
        $note->fill($data)->save();
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