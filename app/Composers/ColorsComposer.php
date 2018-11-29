<?php
/**
 * Created by PhpStorm.
 * User: Vitaliy
 * Date: 29.11.2018
 * Time: 15:16
 */

namespace App\Composers;


use App\Services\ColorService;
use Illuminate\View\View;

/**
 * Class ColorsComposer
 * @package App\Composers
 */
class ColorsComposer
{
    /**
     * @var ColorService
     */
    private $colorService;

    /**
     * ColorsComposer constructor.
     * @param ColorService $colorService
     */
    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('colors', $this->colorService->all());
    }
}