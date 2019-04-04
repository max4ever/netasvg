<?php

namespace App\Shape\Builder;

use App\Shape\CircleShape;
use App\Shape\ShapeInterface;
use App\Shape\SquareShape;

class SquareBuilder extends AbstractShapesBuilder
{

    /**
     * @var int
     */
    private $iSideLength;

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
    private $oSquare;

    /**
     * SquareBuilder constructor.
     * @param SquareShape $oSquare
     */
    public function __construct(SquareShape $oSquare)
    {
        $this->oSquare = $oSquare;
    }

    /**
     * @param int $iSideLength
     * @return SquareBuilder
     */
    public function setSideLength(int $iSideLength) : self
    {
        $this->iSideLength = $iSideLength;
        return $this;
    }

    /**
     * @inheritDoc
     * @return ShapeInterface
     */
    public function getShape(): ShapeInterface
    {
        $this->oSquare->setHeight($this->iSideLength);
        $this->oSquare->setWidth($this->iSideLength);
        $this->oSquare->setBackgroundColor($this->sBorderColor);
        $this->oSquare->setBackgroundWidth($this->iBorderWidth);
        return $this->oSquare;
    }
}