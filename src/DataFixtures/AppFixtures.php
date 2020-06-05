<?php

namespace App\DataFixtures;

use App\Entity\PlanDetails;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {

    $plans = [
      [
        'plan_code' => 'gb',
        'name' => 'UK',
        'monthly_cost' => 10,
        'annual_cost' => 50
      ],
      [
        'plan_code' => 'fr',
        'name' => 'France',
        'monthly_cost' => 10,
        'annual_cost' => 60
      ],
      [
        'plan_code' => 'de',
        'name' => 'Germany',
        'monthly_cost' => 15,
        'annual_cost' => 75
      ],
      [
        'plan_code' => 'us',
        'name' => 'USA',
        'monthly_cost' => 25,
        'annual_cost' => 150
      ],
      [
        'plan_code' => 'jp',
        'name' => 'Japan',
        'monthly_cost' => 15,
        'annual_cost' => 65
      ],
    ];


    foreach ($plans as $plan) {
      $planDetails = new PlanDetails();
      $planDetails->setPlanCode($plan['plan_code']);
      $planDetails->setName($plan['name']);
      $planDetails->setMonthlyCost($plan['monthly_cost']);
      $planDetails->setAnnualCost($plan['annual_cost']);
      $manager->persist($planDetails);
    }

    $manager->flush();
  }
}
