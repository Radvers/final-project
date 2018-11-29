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

    private $color;

    /**
     * HomeController constructor.
     * @param NoteService $noteService
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
        dd($request->only(['title','body','id']));
    }

    public function store()
    {
        dd('save new note');
    }
}
