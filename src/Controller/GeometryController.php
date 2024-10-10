<?php

namespace App\Controller;

use App\Entity\Circle;
use App\Entity\Triangle;
use App\Service\GeometryCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeometryController extends AbstractController
{
    private GeometryCalculator $calculator;

    public function __construct(GeometryCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @Route("/triangle/{a}/{b}/{c}", methods={"GET"})
     */
    public function triangle(float $a, float $b, float $c): JsonResponse
    {
        $triangle = new Triangle($a, $b, $c);
        $properties = $this->calculator->calculateTriangleProperties($triangle);

        return new JsonResponse($properties);
    }

    /**
     * @Route("/circle/{radius}", methods={"GET"})
     */
    public function circle(float $radius): JsonResponse
    {
        $circle = new Circle($radius);
        $properties = $this->calculator->calculateCircleProperties($circle);

        return new JsonResponse($properties);
    }

    /**
     * @Route("/sum/areas", methods={"GET"})
     * @param Request $request
     * We get the area1 and area2 from the query parameters and calculate the sum of areas.
     * @return JsonResponse
     */
    public function sumAreas(Request $request): JsonResponse
    {
        $area1 = $request->query->get('area1');
        $area2 = $request->query->get('area2');

        if (!$area1 || !$area2) {
            return new JsonResponse(['error' => 'Both area1 and area2 must be provided'], 400);
        }

        $area1 = (float)$area1;
        $area2 = (float)$area2;

        $sumAreas = $this->calculator->sumAreas($area1, $area2);

        return new JsonResponse(['sum_of_areas' => $sumAreas]);
    }

    /**
     * @Route("/sum/circumferences", methods={"GET"})
     * @param Request $request
     * We get the diameter1 and diameter2 from the query parameters and calculate the sum of circumferences.
     * @return JsonResponse
     */
    public function sumDiameters(Request $request): JsonResponse
    {
        $diameter1 = $request->query->get('diameter1');
        $diameter2 = $request->query->get('diameter2');

        if (!$diameter1 || !$diameter2) {
            return new JsonResponse(['error' => 'Both area1 and area2 must be provided'], 400);
        }

        $diameter1 = (float)$diameter1;
        $diameter2 = (float)$diameter2;

        $sumDiameters= $this->calculator->sumDiameters($diameter1, $diameter2);

        return new JsonResponse(['sum_of_diameters' => $sumDiameters]);
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }


}
