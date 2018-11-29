<?php

namespace App\Services;


use App\Models\Note;
use App\Services\Auth\AuthInterface;

class SearchService
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
     * SearchService constructor.
     * @param Note $note
     * @param AuthInterface $auth
     */
    public function __construct(Note $note, AuthInterface $auth)
    {
        $this->note = $note;
        $this->auth = $auth;
    }

    /**
     * @param string $search
     * @return mixed
     */
    public function search(string $search)
    {
        $user_id = $this->auth->getUser()->id;
        $notes =  $this->note
            ->where('user_id',$user_id)
            ->where(function($query) use($search) {
                $query->where('title','like','%' . $search . '%')
                    ->orWhere('body','like','%' . $search . '%');
            })->get();
        return $notes;
    }
}