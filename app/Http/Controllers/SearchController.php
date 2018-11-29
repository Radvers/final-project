<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * SearchController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $data = $request->validate([
            'query' => 'required|min:3|max:255'
        ]);
        $notes = $this->searchService->search($data['query']);

        return view('note-list', ['notes' => $notes]);
    }
}
