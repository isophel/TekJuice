<?php
namespace App\Service;

use App\Entity\Circle;
use App\Entity\Triangle;

class GeometryCalculator
{
    public function calculateCircleProperties(Circle $circle): array
    {
        return [
            'type' => 'circle',
            'radius' => $circle->getRadius(),
            'surface' => $circle->calculateSurface(),
            'circumference' => $circle->calculateCircumference(),
        ];
    }

    public function calculateTriangleProperties(Triangle $triangle): array
    {
        return [
            'type' => 'triangle',
            'a' => number_format($triangle->getA(), 1, '.', ''),
            'b' => number_format($triangle->getB(), 1, '.', ''),
            'c' => number_format($triangle->getC(), 1, '.', ''),
            'surface' => number_format($triangle->calculateSurface(), 1, '.', ''),
            'circumference' => number_format($triangle->calculateDiameter(), 1, '.', ''),
        ];
    }

    public function sumAreas(float $area1, float $area2): float
    {
        return round( $area1 + $area2, 2);
    }

    public function sumDiameters(float $diameter1, float $diameter2): float
    {
        return round($diameter1 + $diameter2, 2);
    }
}
