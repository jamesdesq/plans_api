<?php

namespace App\Controller;


use App\Entity\PlanDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PlanDetailsController extends AbstractController {

  /**
   * @Route("/api/v1/plans")
   */
  public function getAll() {

    $plans = $this->getDoctrine()
      ->getRepository(PlanDetails::class)
      ->findAll();

    if (!$plans) {
      throw $this->createNotFoundException(
        'No plans were found'
      );
    }

    $result = [];

    foreach($plans as $plan) {

      $result[] = $this->getValues($plan);
    }

    return $this->json($result);

  }

  /**
   * @Route("/api/v1/plans/{plan_code}")
   *
   * @param string $plan_code the two character plan code
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function getSingle($plan_code) {

    $plan = $this->getDoctrine()
      ->getRepository(PlanDetails::class)
      ->findOneBy(['plan_code' => $plan_code]);

    return $this->json($this->getValues($plan));

  }

  /**
   * @Route("api/v1/plans/costs/{options}")
   * @Method("GET")
   *
   * @param string $options a JSON encoded array of the user's choices
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function getCosts($options) {

    $optionsr = json_decode($options);

    $cost = 0;

    foreach($optionsr as $plan_code => $option) {
      $plan = $this->getDoctrine()
        ->getRepository(PlanDetails::class)
        ->findOneBy(['plan_code' => $plan_code]);
      $cost += $option === 'annual_cost' ? $plan->getAnnualCost() : $plan->getMonthlyCost();
    }

    // @todo maybe yearly total, too?

    return $this->json(['total' => $cost]);
  }


  /**
   * Helper function to make Doctrine results JSON-friendly.
   *
   * @param PlanDetails $result A plan details entity to convert
   *
   * @return array the plan details ready to be JSON encoded.
   */
  public function getValues(PlanDetails $result) {
    return [
      'plan_code' => $result->getPlanCode(),
      'name' => $result->getName(),
      'monthly_cost' => $result->getMonthlyCost(),
      'annual_cost' => $result->getAnnualCost(),
    ];
  }
}