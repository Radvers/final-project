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
        $notes = $this->tagService->index($id);
        $cloudTags = $this->tagService->cloud();
        return view('note-list', ['notes' => $notes, 'cloudTags' => $cloudTags]);
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
