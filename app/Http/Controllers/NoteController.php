<?php

namespace App\Http\Controllers;

use App\Services\NoteService;
use Illuminate\Http\Request;

/**
 * Class NoteController
 * @package App\Http\Controllers
 */
class NoteController extends Controller
{
    /**
     * @var NoteService
     */
    private $noteService;

    /**
     * HomeController constructor.
     * @param NoteService $noteService
     */
    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
        $this->middleware('auth');
    }

    /**
     * Show all user notes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = $this->noteService->getAllUserNotes();

        return view('notes', ['notes' => $notes]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        dd($this->noteService->getById($id));

        return view('createNote');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(int $id)
    {
        $this->noteService->delete($id);

        return redirect('/notes');
    }


    public function update()
    {
        dd('update note');
    }

    public function store()
    {
        dd('save new note');
    }
}
