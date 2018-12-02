<?php

namespace App\Services;

use App\Models\Note;

/**
 * Class ShareService
 * @package App\Services
 */
class ShareService
{
    /**
     * @var Note
     */
    private $note;

    /**
     * ShareService constructor.
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
    public function getSharedNote(int $id)
    {
        return $this->note->where('id', $id)->where('share', true)->with(['color', 'user'])->first();
    }
}