<?php

namespace App\Shape;

class CircleShape implements ShapeInterface
{

    //private const HTML_TAG = '<circle cx="%s" cy="%s" r="%s" stroke="%s" stroke-width="%s" fill="%s" />';//for reference

    private const DEFAULT_CIRCLE_X_CENTER = 100;
    private const DEFAULT_CIRCLE_Y_CENTER = 100;
    private const DEFAULT_FILL = 'transparent';
    /**
     * @var \DOMElement
     */
    private $oDomElement;

    public function __construct()
    {
        $domDocument = new \DOMDocument('1.0', "UTF-8");
        $this->oDomElement = $domDocument->createElement('circle');
        $this->oDomElement->setAttribute('cx', self::DEFAULT_CIRCLE_X_CENTER);
        $this->oDomElement->setAttribute('cy', self::DEFAULT_CIRCLE_Y_CENTER);
        $this->oDomElement->setAttribute('fill', self::DEFAULT_FILL);
    }

    /**
     * @param string $sRadius
     */
    public function setRadius(string $sRadius) : void
    {
        $this->oDomElement->setAttribute('r', $sRadius);
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
        return $this->oDomElement->ownerDocument->saveHTML($this->oDomElement);
    }
}