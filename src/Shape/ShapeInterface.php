<?php

namespace App\Shape;

interface ShapeInterface{

    /**
     * Get the code to insert inside the <svg> tag </svg>
     * @return string
     */
    public function getSvgCode() : string;
}