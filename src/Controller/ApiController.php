<?php

namespace App\Controller;

use App\Exception\InvalidCircleJsonException;
use App\Exception\UnsupportedShapeTypeException;
use App\Shape\Factory\ShapesFactory;
use App\Svg\SvgResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{

    /**
     * @Route("/api/draw-me-like-one-of-your-french-girls/", methods={"POST"}, name="generate_svg")
     *
     * @param Request $request
     * @param ShapesFactory $oShapeFactory
     * @param SvgResponse $oSvgResponse
     * @return SvgResponse|Response
     */
    public function mainAction(Request $request, ShapesFactory $oShapeFactory, SvgResponse $oSvgResponse)
    {
        $aShapes = $request->get('shapes');

        $sHTML = '';
        if (is_countable($aShapes)){
            foreach($aShapes as $aShape){

                if (!isset($aShape['type'])){
                    return Response::create('Invalid json, missing type of shape.', Response::HTTP_BAD_REQUEST);
                }

                try{
                    $oShape = $oShapeFactory->getShape($aShape['type'], $aShape);
                    if (!empty($oShape)){
                        $sHTML .= $oShape->getSvgCode();
                    }
                }
                catch(InvalidCircleJsonException $e){
                    return Response::create('Invalid json data structure for circle shape: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
                }
                catch(UnsupportedShapeTypeException $e){
                    return Response::create('Unsported shape "' . $aShape['type'] .'" ', Response::HTTP_BAD_REQUEST);
                }
            }
        }

        $oSvgResponse->setContent($sHTML);

        return $oSvgResponse;
    }
}