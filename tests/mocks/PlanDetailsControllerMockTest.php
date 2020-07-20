<?php

namespace App\Tests\mocks;

require './vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\Serializer\Serializer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class PlanDetailsControllerMockTest extends TestCase {

  private $mock;

  private $client;

  public function setUp() {

    $this->mock = new MockHandler([
      new Response(200, [], $this->dummyResponse()),
      new Response(200, [], $this->dummyResponse('gb'))
    ]);
    $handlerStack = HandlerStack::create($this->mock);
    $this->client = new Client(['handler' => $handlerStack]);
  }

  public function tearDown() {
//    $this->http = null;
  }

  /**
   * Gets all plans
   */
  public function testGetAll() {

    $response = $this->client->request('GET', 'api/v1/plans');

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

    $this->mock = new MockHandler([
      new Response(200, [], $this->dummyResponse('gb'))
    ]);
    $handlerStack = HandlerStack::create($this->mock);
    $this->client = new Client(['handler' => $handlerStack]);

    $response = $this->client->request('GET', 'api/v1/plans/gb');

    $this->assertEquals(200, $response->getStatusCode());

    $plan = json_decode($response->getBody(true), true);

    $this->assertArrayHasKey( 'plan_code', $plan);

    $this->assertArrayHasKey('name', $plan);

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

    $this->markTestSkipped('Needs a mock');

    $options = [
      'gb' => 'monthly_cost',
      'fr' => 'annual_cost',
    ];

    $response = $this->http->request('GET', 'api/v1/plans/costs/' . json_encode($options));

    $costs = json_decode($response->getBody(true), true);

    $this->assertArrayHasKey('total', $costs);

    $this->assertEquals($costs['total'], 70);

  }

  /*
   * Helper function for mocking responses.
   * @todo should integrate with actual API code
   */
  private function dummyResponse($plan_code = NULL) {

    $response = '[{"plan_code":"gb","name":"UK","monthly_cost":10,"annual_cost":50},{"plan_code":"fr","name":"France","monthly_cost":10,"annual_cost":60},{"plan_code":"de","name":"Germany","monthly_cost":15,"annual_cost":75},{"plan_code":"us","name":"USA","monthly_cost":25,"annual_cost":150},{"plan_code":"jp","name":"Japan","monthly_cost":15,"annual_cost":65}]';

    if ($plan_code) {
      $json_response = json_decode($response, TRUE);
      $selected_plan = [];
      foreach ($json_response as $key => $plan) {
        if ($plan['plan_code'] === $plan_code) {
          $selected_plan = $plan;
        }
      }
      print_r($selected_plan);
      $response = json_encode($selected_plan);
    }
    return $response;
  }
}