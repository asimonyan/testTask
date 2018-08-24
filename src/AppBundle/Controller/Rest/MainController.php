<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\Credit;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\RouteResource("main")
 * @Rest\Prefix("/api/v1.0")
 * @Rest\NamePrefix("rest_")
 */
class MainController extends FOSRestController
{
    /**
     * @return Response
     * @Rest\Get("/schedule")
     * @Rest\View()
     */
    public function getScheduleAction(Request $request)
    {
        $params = $request->query->all();
        $credit = new Credit($params);

        $validator = $this->get('validator');
        $errors = $validator->validate($credit);

        if (count($errors) > 0) {

            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }

            return $this->json($errorMessages, Response::HTTP_BAD_REQUEST);
        }

        // get entity manager
        $em = $this->get('doctrine')->getManager();
        $em->persist($credit);

        $mainService = $this->get('main_service');
        $result = $mainService->calculateSchedule($credit);

        return $this->json($result);
    }
}