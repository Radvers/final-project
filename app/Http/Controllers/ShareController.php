<?php

namespace App\Http\Controllers;

use App\Services\ShareService;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    /**
     * @var ShareService
     */
    private $shareService;

    /**
     * ShareController constructor.
     * @param ShareService $shareService
     */
    public function __construct(ShareService $shareService)
    {
        $this->shareService = $shareService;
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $id)
    {
        $note = $this->shareService->getSharedNote($id);

        return view('sharedNote',['note' => $note]);
    }
}
