<?php declare(strict_types=1)?>
<?php

use API\Web;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase {

    protected $web;

    public function setUp(): void
    {
        $this->web = new Web();
    }

    public function testFailCurlConnection()
    {
        $response = $this->web->connect('www.samplewrongapi.com');

        $this->assertEquals(
            $response,
            [
                'error' => true,
                'data' => 'Couldn\'t send request to server.'
            ]
        );
    }

    public function testCurlConnectionMustBeArrayErrorIsFalse()
    {
        $response = $this->web->connect('https://api.exchangeratesapi.io/latest');

        $this->assertFalse($response['error']);
    }

}