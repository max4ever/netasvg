<?php

namespace App\Shape\Builder;

use App\Shape\CircleShape;
use App\Shape\ShapeInterface;

class CircleBuilder extends AbstractShapesBuilder
{

    /**
     * @var int
     */
    private $iPerimeter;

    /**
     * @var string
     */
    protected $sBorderColor;

    /**
     * @var int
     */
    protected $iBorderWidth;

    /**
     * @var CircleShape
     */
    private $oCircle;

    /**
     * CircleBuilder constructor.
     */
    public function __construct()
    {
        $this->oCircle = new CircleShape();
    }

    /**
     * @param int $iPerimeter
     * @return $this
     */
    public function setPerimeter(int $iPerimeter) : CircleBuilder
    {
        $this->iPerimeter = $iPerimeter;
        return $this;
    }

    /**
     * @inheritDoc
     * @return ShapeInterface
     */
    public function getShape(): ShapeInterface
    {
        $this->oCircle->setRadius(intval($this->iPerimeter / 2 / pi()));
        $this->oCircle->setBackgroundColor($this->sBorderColor);
        $this->oCircle->setBackgroundWidth($this->iBorderWidth);
        return $this->oCircle;
    }
}