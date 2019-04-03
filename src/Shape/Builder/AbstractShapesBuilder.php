<?php

namespace App\Shape\Builder;

use App\Shape\ShapeInterface;

abstract class AbstractShapesBuilder
{

    protected $sBorderColor;
    protected $iBorderWidth;

    /**
     * Set shape border color
     * @param $sBorderColor
     * @return $this
     */
    public final function setBorderColor($sBorderColor)
    {
        $this->sBorderColor = $sBorderColor;
        return $this;
    }

    /**
     * Set shape border width
     * @param int $iBorderWidth
     * @return $this
     */
    public final function setBorderWidth(int $iBorderWidth)
    {
        $this->iBorderWidth = $iBorderWidth;
        return $this;
    }

    /**
     * Get the built shape
     * @return ShapeInterface
     */
    public abstract function getShape(): ShapeInterface;
}