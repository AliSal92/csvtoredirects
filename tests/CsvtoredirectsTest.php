<?php

use AliSal\Csvtoredirects;
use PHPUnit\Framework\TestCase;

class CsvtoredirectsTest extends TestCase
{

    /**
     * Redirects
     *
     * @var Csvtoredirects
     */
    protected $redirects;

    /**
     * Setup
     * Setup our test environment objects
     */
    protected function setUp() :void {
        $this->redirects = new Csvtoredirects(__DIR__ . '/examples/redirects.csv');
    }

    function test_load() :void {
        $this->redirects->load();
        $this->assertIsArray($this->redirects->csv->data);
        $this->assertNotEmpty($this->redirects->csv->data);
    }

    function test_start() :void {
        // to suppress headers already sent from the redirect code
        error_reporting(0);

        $this->assertFalse( $this->redirects->start('qweqwe') );
        $this->assertTrue( $this->redirects->start('https://www.mywebsite.com') );
    }

}
