<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController {

  /**
   * @Route()
   */
  public function home() {

    return new Response('This app implements an API for retrieving details about subscription plans. You can find all the details in the README.md file');

  }

}