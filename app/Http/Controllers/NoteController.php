<?php

namespace App\Http\Controllers;

use App\Services\NoteService;
use App\Services\TagService;
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
     * @var TagService
     */
    private $tagService;

    /**
     * NoteController constructor.
     * @param NoteService $noteService
     * @param TagService $tagService
     */
    public function __construct(NoteService $noteService, TagService $tagService)
    {
        $this->noteService = $noteService;
        $this->tagService = $tagService;
        $this->middleware('auth');
    }

    /**
     * Show all user notes.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = $this->noteService->getAllUserNotes();

        return view('note-list', ['notes' => $notes]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $note = $this->noteService->getById($id);

        return view('note', ['note' => $note]);
    }

    /**
     * page with create form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('createNote');
    }

    /**
     * page with update form
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
     * Edit in modal window
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quickEdit(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:4|max:255',
            'body' => 'required|min:4',
            'id' => 'required|digits_between:1,10',
            'color_id' => 'required|digits_between:1,10',
            'share' => 'boolean'
        ]);
        $this->noteService->update($data);

        return redirect()->back();
    }

    /**
     * Edit at update page
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
            'days_to_delete' => 'required|integer',
            'share' => 'boolean',
            'file' => 'max:4096',
            'tags' => ''
        ]);
        $this->noteService->update($data);
        $this->tagService->updateTags($data);

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
            'days_to_delete' => 'required|integer',
            'share' => 'boolean',
            'file' => 'max:4096',
            'tags' => ''
        ]);
        $id = $this->noteService->store($data);
        $data['id'] = $id;
        $this->tagService->updateTags($data);

        return redirect('/notes');
    }
}
