<?php

namespace App\Tests;

require './vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;

class PlanSaveControllerTest extends TestCase {

  private $http;

  public function setUp() {

    $this->http = new Client(['base_uri' => 'http://localhost:8000']);
  }

  public function tearDown() {
    $this->http = null;
    // @todo should really implement delete method on the users_saved_plans to clean up test data.
  }

  /**
   * Allows the user to save their desired plans and billing frequency.
   */
  public function testPlanSave() {

    $data = array(
      'user_id' => 'ABC123',
      'plan_code' => 'de',
      'billing_frequency' => 'monthly'
    );

    $response = $this->http->request('POST', 'api/vi/account-management/plans', [
      'body' => json_encode($data)
    ]);

    $result = json_decode($response->getBody(true), true);

    $this->assertEquals($result['result'], 'The plan for ABC123 was saved successfully');
  }


  /**
   * Allows the user to save their desired plans and billing frequency.
   */
  public function testMalformedPlan() {
    $data = array(
      'wrong' => 'Malicious code',
    );

    $guzzleResult = "";

    try {
      $response = $this->http->request('POST', 'api/vi/account-management/plans', [
        'body' => json_encode($data)
      ]);
    } catch(RequestException $e) {
      $guzzleResult = $e->getResponse()->getStatusCode();
    }

    $this->assertEquals(400, $guzzleResult);

  }

}