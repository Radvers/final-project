<?php

namespace App\Composers;

use App\Services\TagService;
use Illuminate\View\View;

/**
 * Class CloudTagsComposer
 * @package App\Composers
 */
class CloudTagsComposer
{
    /**
     * @var TagService
     */
    private $tagService;

    /**
     * CloudTagsComposer constructor.
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
        $view->with('cloudTags', $this->tagService->cloud());
    }
}