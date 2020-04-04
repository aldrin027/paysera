
<?php

use Controller\Business;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase {

    protected $app;

    public function setUp(): void
    {
        $this->app = new Business();
    }

    public function testFileOpenMustReturnArrayOfData()
    {
        $response = $this->app->readFile('sample.txt');

        $this->assertIsArray($response);
    }
    
    public function testErrorFileOpenNotExist()
    {
        $response = $this->app->readFile('sample2.txt');

        $this->assertEquals(
            $response['data'],
            "File not exists!"
        );
    }

    public function testExectuteSucess()
    {
        $response = $this->app->execute('sample.txt');

        $this->assertIsString($response);

    }


}
?>