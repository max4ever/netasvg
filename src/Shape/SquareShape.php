<?php

namespace App\Shape;

class SquareShape implements ShapeInterface{

    use ShapeTrait;

    /*<rect x="10" y="10" width="30" height="30"/>*/

    private const DEFAULT_X_CENTER = 50;
    private const DEFAULT_Y_CENTER = 50;
    /**
     * @var \DOMElement
     */
    private $oDomElement;

    public function __construct()
    {
        $domDocument = new \DOMDocument('1.0', "UTF-8");
        $this->oDomElement = $domDocument->createElement('rect');
        $this->oDomElement->setAttribute('x', self::DEFAULT_X_CENTER);
        $this->oDomElement->setAttribute('y', self::DEFAULT_Y_CENTER);
    }

    /**
     * @param int $iWidth
     */
    public function setWidth(int $iWidth) : void
    {
        $this->oDomElement->setAttribute('width', $iWidth);
    }

    /**
     * @param int $iHeight
     */
    public function setHeight(int $iHeight) : void
    {
        $this->oDomElement->setAttribute('height', $iHeight);
    }

    /**
     * @param string $sColor
     */
    public function setBackgroundColor(string $sColor) : void
    {
        $this->oDomElement->setAttribute('stroke', $sColor);
    }

    /**
     * @param int $iBorderWidth
     */
    public function setBackgroundWidth(int $iBorderWidth): void
    {
        $this->oDomElement->setAttribute('stroke-width', $iBorderWidth);
    }

    /**
     * @return string
     */
    public function getSvgCode(): string
    {
        return $this->getHtmlTag($this->oDomElement);
    }
}