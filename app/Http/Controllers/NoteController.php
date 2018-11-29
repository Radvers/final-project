<?php

namespace App\Http\Controllers;

use App\Models\Color;
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
     * @var Color
     */
    private $color;

    /**
     * NoteController constructor.
     * @param NoteService $noteService
     * @param Color $color
     */
    public function __construct(NoteService $noteService, Color $color)
    {
        $this->color =$color;
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
        $colors = $this->color->get();

        return view('notes', ['notes' => $notes, 'colors' => $colors]);
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


    public function update(Request $request)
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

    public function store()
    {
        dd('save new note');
    }
}
