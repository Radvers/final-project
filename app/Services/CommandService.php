<?php

namespace App\Services;

use App\Models\Note;

/**
 * Class CommandService
 * @package App\Services
 */
class CommandService
{
    /**
     * @var Note
     */
    private $note;

    /**
     * CommandService constructor.
     * @param Note $note
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Delete Expired Notes
     */
    public function deleteExpired()
    {

        $this->note->whereRaw('to_days(now()) - to_days(created_at) >= days_to_delete')->delete();
    }

}