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
        $this->note->whereRaw('created_at < DATE_SUB(now(), INTERVAL days_to_delete DAY)')->delete();
    }

}