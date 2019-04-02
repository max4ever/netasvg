<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{

    /**
     * @Route("/api/draw-me-like-one-of-your-french-girls/", methods={"POST"}, name="generate_svg")
     */
    public function indexAction(Request $request)
    {
        $aShapes = $request->get('shapes');

        dump($aShapes);
        return new Response('Test');
    }
}