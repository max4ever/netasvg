<?php

namespace App\Shape;

class RectangleShape implements ShapeInterface{

    private const HTML_TAG = '<rect x="10" y="10" width="30" height="30"/>';

    /**
     * @inheritDoc
     * @return string
     */
    public function getSvgCode() : string
    {
        //TODO finish
       return self::HTML_TAG;
    }
}