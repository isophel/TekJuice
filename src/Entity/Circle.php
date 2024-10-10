<?php
namespace App\Entity;

class Circle {
    private float $radius;

    /**
     * Using Constructor Injection for immutability of the Circle object
     * @param float $radius
     */
    public function __construct(float $radius) {
        $this->radius = $radius;
    }

    public function getRadius(): float {
        return $this->radius;
    }

    /**
     * Truncate a float to a given number of decimal places
     * @param float $value
     * @param int $decimalPlaces
     * @return float
     */
    private function truncate(float $value, int $decimalPlaces): float
    {
        $factor = pow(10, $decimalPlaces);
        return floor($value * $factor) / $factor;
    }

    /**
     * @return float
     */
    public function calculateSurface()
    {
        return $this->truncate(pi() * pow($this->radius, 2), 2);
    }

    /**
     * @return float
     */
    public function calculateDiameter()
    {
        return $this->truncate($this->radius * 2, 2);
    }

    /**
     * @return float
     */
    public function calculateCircumference()
    {
        return $this->truncate(2 * pi() * $this->radius, 2);
    }


}