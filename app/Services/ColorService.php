<?php
/**
 * Created by PhpStorm.
 * User: Vitaliy
 * Date: 29.11.2018
 * Time: 15:17
 */

namespace App\Services;


use App\Models\Color;

/**
 * Class ColorService
 * @package App\Services
 */
class ColorService
{
    /**
     * @var Color
     */
    private $color;

    /**
     * ColorService constructor.
     * @param Color $color
     */
    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function all()
    {
        return $this->color->get();
    }
}