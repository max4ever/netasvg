<?php

namespace App\Test\Svg;

use App\Svg\SvgResponse;
use PHPUnit\Framework\TestCase;


class SvgResponseTest extends TestCase
{

    public function testResponseHeader(){
        $oSvgResponse = new SvgResponse();

        $this->assertEquals('image/svg+xml', $oSvgResponse->headers->get('Content-Type'));
    }

    public function testSvgStructure(){
        $oSvgResponse = new SvgResponse('test');

        ob_start();
        $oSvgResponse->sendContent();
        $sOuput = ob_get_clean();
        $this->assertEquals(sprintf(SvgResponse::HTML_TEMPLATE, 'test'), $sOuput);
    }
}