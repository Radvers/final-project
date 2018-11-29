<?php

namespace App\Services;


use App\Models\Note;
use App\Services\Auth\AuthInterface;
use Illuminate\Support\Facades\Auth;

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
        return $this->note->ByField('id', $id)->get();
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
        $data['user_id'] = $this->auth->getUser()->id;
        $this->note->ByField('id', $data['id'])->update($data);
    }

}