<?php

namespace App\Shape;

trait ShapeTrait{

    /**
     * @param \DOMElement $oDomElement
     * @return string
     */
    public function getHtmlTag(\DOMElement $oDomElement): string
    {
        return $oDomElement->ownerDocument->saveHTML($this->oDomElement);
    }
}