<?php

namespace App\Shape\Factory;

use App\Entity\Circle;
use App\Exception\InvalidCircleJsonException;
use App\Exception\UnsupportedShapeTypeException;
use App\Shape\Builder\CircleBuilder;
use App\Shape\RectangleShape;
use App\Shape\ShapeInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ShapesFactory
{

    const CIRCLE = 'circle';
    const SQUARE = 'square';

    /**
     * @var ValidatorInterface
     */
    private $oValidator;

    /**
     * @var CircleBuilder
     */
    private $oCircleBuilder;

    /**
     * ShapesFactory constructor.
     * @param ValidatorInterface $validator
     * @param CircleBuilder $oCircleBuilder
     */
    public function __construct(ValidatorInterface $validator, CircleBuilder $oCircleBuilder)
    {
        $this->oValidator = $validator;
        $this->oCircleBuilder = $oCircleBuilder;
    }

    /**
     * Create desired Shape
     *
     * @param string $sType
     * @param array $aProperties
     * @return RectangleShape|ShapeInterface|null
     * @throws InvalidCircleJsonException
     * @throws UnsupportedShapeTypeException
     */
    public function getShape(string $sType, array $aProperties)
    {
        $oShape = null;

        switch ($sType) {

            case self::CIRCLE:
                $oShape = $this->getCircleShape($aProperties);
                break;

            case self::SQUARE:
                $oShape = new RectangleShape($aProperties);
                break;

            default:
                throw new UnsupportedShapeTypeException();
        }

        return $oShape;
    }

    /**
     * @param array $aProperties
     * @return ShapeInterface
     * @throws InvalidCircleJsonException
     */
    private function getCircleShape(array $aProperties)
    {
        if ($this->validateCircleProperties($aProperties) === true) {
            return $this->oCircleBuilder
                ->setBorderColor($aProperties['border']['color'])
                ->setBorderWidth($aProperties['border']['width'])
                ->setPerimeter($aProperties['perimeter'])
                ->getShape();
        } else {
            return null;
        }
    }

    /**
     * @param array $aProperties
     * @return bool
     * @throws InvalidCircleJsonException
     */
    private function validateCircleProperties(array $aProperties): bool
    {
        $oCircle = new Circle($aProperties);
        $oFailedConstraints = $this->oValidator->validate($oCircle);


        if (count($oFailedConstraints) > 0) {
            $sErrorsString = '';
            foreach ($oFailedConstraints as $oFailedConstraint) {
                /* @var $oFailedConstraint ConstraintViolationInterface */
                $sErrorsString .= $oFailedConstraint->getMessage() . ' ' . $oFailedConstraint->getInvalidValue();
            }

            throw new InvalidCircleJsonException($sErrorsString);
        }

        return true;
    }
}