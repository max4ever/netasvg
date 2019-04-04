<?php

namespace App\Shape\Factory;

use App\Entity\Circle;
use App\Exception\InvalidCircleJsonException;
use App\Exception\UnsupportedShapeTypeException;
use App\Shape\Builder\CircleBuilder;
use App\Shape\Builder\SquareBuilder;
use App\Shape\SquareShape;
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
     * @var SquareBuilder
     */
    private $oSquareBuilder;

    /**
     * ShapesFactory constructor.
     * @param ValidatorInterface $validator
     * @param CircleBuilder $oCircleBuilder
     * @param SquareBuilder $oSquareBuilder
     */
    public function __construct(ValidatorInterface $validator, CircleBuilder $oCircleBuilder, SquareBuilder $oSquareBuilder)
    {
        $this->oValidator = $validator;
        $this->oCircleBuilder = $oCircleBuilder;
        $this->oSquareBuilder = $oSquareBuilder;
    }

    /**
     * Create desired Shape
     *
     * @param string $sType
     * @param array $aProperties
     * @return SquareShape|ShapeInterface|null
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
                $oShape = $this->getSquareShape($aProperties);
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
     * @return ShapeInterface
     * @throws InvalidCircleJsonException
     */
    private function getSquareShape(array $aProperties)
    {
        if ($this->validateSquareProperties($aProperties) === true) {
            return $this->oSquareBuilder
                ->setBorderColor($aProperties['border']['color'])
                ->setBorderWidth($aProperties['border']['width'])
                ->setSideLength($aProperties['sideLength'])
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
        $oCircle = new Circle($aProperties);//TODO inject
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


    /**
     * @param array $aProperties
     * @return bool
     * @throws InvalidCircleJsonException
     */
    private function validateSquareProperties(array $aProperties): bool
    {
        $oCircle = new SquareShape($aProperties);//TODO inject
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