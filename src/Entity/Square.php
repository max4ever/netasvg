<?php

namespace App\Entity;

class Square{

    /**
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\GreaterThan(0)
     */
    private $sideLength;

    /**
     * @Assert\NotBlank()
     * @Assert\Collection(
     *     fields={
     *         "color" = @Assert\Required({@Assert\NotBlank, @Assert\Type("string")}),
     *         "width" = @Assert\Optional(@Assert\NotBlank(), @Assert\Type("integer"))
     *     }
     * )
     *
     * //TODO add custom color validator
     */
    private $border;


    public function __construct(array $properties = [])
    {
        foreach ($properties as $key => $value) {
            $this->{$key} = $value;
        }
    }
}