<?php

namespace App\Tests;

require './vendor/autoload.php';

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class PlanDetailsControllerTest extends TestCase {

  private $http;

  public function setUp() {

    $this->http = new Client(['base_uri' => 'http://localhost:8000']);
  }

  public function tearDown() {
    $this->http = null;
  }

  /**
   * Gets all plans
   */
  public function testGetAll() {

    $response = $this->http->request('GET', 'api/v1/plans');

    $this->assertEquals(200, $response->getStatusCode());

    $plans = json_decode($response->getBody(true), true);

    $this->assertEquals(5, count($plans));

    $single = array_pop($plans);

    $this->assertArrayHasKey( 'plan_code', $single);

    $this->assertArrayHasKey('name', $single);

    $this->assertArrayHasKey('monthly_cost', $single);

    $this->assertArrayHasKey('annual_cost', $single);

  }

  /**
   * Queries for a specific plan
   */

  public function testGetSingle() {

    $response = $this->http->request('GET', 'api/v1/plans/gb');

    $this->assertEquals(200, $response->getStatusCode());

    $plan = json_decode($response->getBody(true), true);

    $this->assertArrayHasKey( 'plan_code', $plan);

    $this->assertArrayHasKey('name', $plan);

    $this->assertArrayHasKey('monthly_cost', $plan);

    $this->assertArrayHasKey('annual_cost', $plan);

    $this->assertEquals('gb', $plan['plan_code']);

    $this->assertEquals('UK', $plan['name']);

    $this->assertEquals(50, $plan['annual_cost']);

    $this->assertEquals(10, $plan['monthly_cost']);

  }


  /**
   * Calculates the subscription cost based on the chosen plan codes, including the monthly and annual cost.
   */
  public function testGetSubscriptionCost() {

    $options = [
      'gb' => 'monthly_cost',
      'fr' => 'annual_cost',
    ];

    $response = $this->http->request('GET', 'api/v1/plans/costs/' . json_encode($options));

    $costs = json_decode($response->getBody(true), true);

    $this->assertArrayHasKey('total', $costs);

    $this->assertEquals($costs['total'], 70);

  }
}