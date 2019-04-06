<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use \Symfony\Component\HttpFoundation\Response;

class ApiControllerTest extends WebTestCase
{

    public function testApiRouteEmptyRequestCodeStatus()
    {

        $client = self::createClient();
        $client->request('POST', '/api/draw/');

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
    }

    public function testApiRouteContent()
    {

        $client = self::createClient();

        $client->request('POST', '/api/draw/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"shapes": [
                    {
                        "type": "circle",
                        "perimeter": 100,
                        "border": {
                            "color": "red",
                            "width": -5
                        }
                    },
                    {
                        "type": "square",
                        "sideLength": 10,
                        "border": {
                            "color": "#776cff",
                            "width": 2
                        }
                    },
                    {
                        "type": "circle",
                        "perimeter": 50,
                        "border": {
                            "color": "blue",
                            "width": -10
                        }
                    }
                ]
            }'
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $this->assertContains(
            '<circle cx="100" cy="100" fill="transparent" r="15" stroke="red" stroke-width="-5"></circle><rect x="50" y="50" height="10" width="10" stroke="#776cff" stroke-width="2"></rect><circle cx="100" cy="100" fill="transparent" r="7" stroke="blue" stroke-width="-10"></circle>',
            $client->getResponse()->getContent()
        );
    }
}
