<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Circle
{

    /**
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\GreaterThan(0)
     */
    private $perimeter;

    /**
     * @Assert\NotBlank()
     * @Assert\Collection(
     *     fields={
     *         "color" = @Assert\Required({@Assert\NotBlank, @Assert\Type("string")}),
     *         "width" = @Assert\Optional(@Assert\NotBlank(), @Assert\Type("integer"))
     *     }
     * )
     *
     * //TODO better check of color
     */
    private $border;


    public function __construct(array $properties = [])
    {
        foreach ($properties as $key => $value) {
            $this->{$key} = $value;
        }
    }
}