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
     * NoteController constructor.
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

        return view('note-list', ['notes' => $notes]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('createNote');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(int $id)
    {
        $note = $this->noteService->getById($id);

        return view('updateNote', ['note' => $note]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $id)
    {
        $this->noteService->delete($id);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quickEdit(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:4|max:255',
            'body' => 'required|min:4',
            'id' => 'required|digits_between:1,10',
            'color_id' => 'required|digits_between:1,10'
        ]);
        $this->noteService->update($data);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fullEdit(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'title' => 'required|min:4|max:255',
            'body' => 'required|min:4',
            'color_id' => 'required|integer',
            'days_to_delete' => 'required|integer'
        ]);

        $this->noteService->update($data);

        return redirect('/notes');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:4|max:255',
            'body' => 'required|min:4',
            'color_id' => 'required|integer',
            'days_to_delete' => 'required|integer'
        ]);
        $this->noteService->store($data);

        return redirect('/notes');
    }
}
