<?php

namespace App\Svg;

use Symfony\Component\HttpFoundation\Response;

class SvgResponse extends Response
{
    private const HTML_TEMPLATE = '<?xml version="1.0" standalone="no"?><svg width="200" height="250" version="1.1" xmlns="http://www.w3.org/2000/svg">%s</svg>';

    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
        $this->headers->set('Content-Type', 'image/svg+xml');
    }

    /**
     * @inheritDoc
     */
    public function sendContent()
    {
        echo sprintf(self::HTML_TEMPLATE, $this->content);

        return $this;
    }
}