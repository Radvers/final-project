<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;

/**
 * Class TagController
 * @package App\Http\Controllers
 */
class TagController extends Controller
{
    /**
     * @var TagService
     */
    private $tagService;

    /**
     * TagController constructor.
     * @param TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
        $this->middleware('auth');
    }

    public function index(int $id)
    {
        $tag = $this->tagService->index($id);
        $notes = $tag->notes;
        return view('note-list', ['notes' => $notes]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:50'
        ]);
        $this->tagService->store($data['name']);

        return redirect()->back();
    }

    public function cloud()
    {
        return $this->tagService->cloud();
    }
}
