
<?php

use Utils\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase {


    protected $helper;

    public function setUp(): void
    {
        $this->helper = new Helper();
    }

    public function testComputationIsEu()
    {
        $this->assertEquals($this->helper->compute(20, true), 0.2);
    }

    public function testComputationIsNotEu()
    {
        $this->assertEquals($this->helper->compute(20, false), 0.4);
    }

    public function testIsEu()
    {
        $response = $this->helper->isEu('AT');
        $this->assertTrue($response);
    }

    public function testIsNotEu()
    {
        $response = $this->helper->isEu('OP');
        $this->assertFalse($response);
    }
}
?>