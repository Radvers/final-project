<?php

namespace App\Composers;

use App\Services\TagService;
use Illuminate\View\View;

/**
 * Class TagsComposer
 * @package App\Composers
 */
class TagsComposer
{
    /**
     * @var TagService
     */
    private $tagService;

    /**
     * TagsComposer constructor.
     * @param TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('tags', $this->tagService->all());
    }
}