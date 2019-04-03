<?php

namespace App\Shape\Factory;

use App\Entity\Circle;
use App\Exception\InvalidCircleJsonException;
use App\Exception\UnsupportedShapeTypeException;
use App\Shape\Builder\CircleBuilder;
use App\Shape\RectangleShape;
use App\Shape\ShapeInterface;
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

                if (!$this->validateCircleProperties($aProperties)) {
                    throw new InvalidCircleJsonException('array structure is not matching circle requirements');
                }
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
     * Get the Circle shape based on the properties array
     * @param array $aProperties
     * @return ShapeInterface
     */
    private function getCircleShape(array $aProperties)
    {
        $this->validateCircleProperties($aProperties);

        return $this->oCircleBuilder
            ->setBorderColor($aProperties['border']['color'])
            ->setBorderWidth($aProperties['border']['width'])
            ->setPerimeter($aProperties['perimeter'])
            ->getShape();
    }

    /**
     * Check if the circle array has the correct structure and values
     * @param array $aProperties
     * @return bool
     */
    private function validateCircleProperties(array $aProperties): bool
    {
        $metadata = $this->oValidator->getMetadataFor(Circle::class);
        $constrainedProperties = $metadata->getConstrainedProperties();
        foreach ($constrainedProperties as $constrainedProperty) {
            if (!isset($aProperties[$constrainedProperty])){
                return false;
            }
            $propertyMetadata = $metadata->getPropertyMetadata($constrainedProperty);
            $constraints = $propertyMetadata[0]->constraints;
            foreach ($constraints as $constraint) {
                //TODO fix checks
                if ( !$this->oValidator->validate($aProperties[$constrainedProperty], $constraint) ){
                    return false;
                }
            }
        }
        return true;
    }
}