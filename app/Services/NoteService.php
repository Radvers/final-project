<?php

namespace App\Services;


use App\Models\Note;
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
     * NoteService constructor.
     * @param Note $note
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
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
        return $this->note->ByField('user_id', Auth::id())->get();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->note->ByField('id', $id)->delete();
    }

}