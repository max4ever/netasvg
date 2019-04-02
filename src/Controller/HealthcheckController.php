<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthcheckController
{

    /**
     * @Route("/ping", methods={"GET"}, name="healthcheck")
     */
    public function __invoke(): object
    {
        return new JsonResponse('pong');
    }
}
