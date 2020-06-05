<?php

namespace App\Controller;

use App\Entity\UsersSavedPlans;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlanSaveController extends AbstractController {

  /**
   * @Route("api/vi/account-management/plans")
   * @Method("POST")
   */
  public function save(Request $request) {

    $data = $request->getContent();

    $datar = json_decode($data, TRUE);

    $request_structure = [
      'user_id',
      'plan_code',
      'billing_frequency'
    ];

    if (!empty(array_diff($request_structure, array_keys($datar)))) {
      return new JsonResponse([
        'error' => 'Malformed request'
      ], 400);    }

    else {
      $entityManager = $this->getDoctrine()->getManager();

      $usp = new UsersSavedPlans();
      $usp->setUserId($datar['user_id'])
        ->setPlanCode($datar['plan_code'])
        ->setBillingFrequency($datar['billing_frequency']);

      $entityManager->persist($usp);
      $entityManager->flush();

      return $this->json(['result' => 'The plan for ' . $datar['user_id'] . ' was saved successfully']);
    }
  }
}
