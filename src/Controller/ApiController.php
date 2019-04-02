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
        $aParameters = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                return new JsonResponse(
                    [
                        'status' => 'error',
                        'error_message' => 'Unable to parse response body into JSON: ' . json_last_error()
                    ],
                    JsonResponse::HTTP_BAD_REQUEST
                );

                throw new \RuntimeException('Unable to parse response body into JSON: ' . json_last_error());
            }
        }

        dump($parametersAsArray);
        return new Response('Test');
    }
}