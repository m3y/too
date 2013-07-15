<?php
namespace M3y\Tooo\ToooTest;

class ToooTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function クラスが存在すること()
    {
        $this->assertTrue(class_exists('M3y\Tooo\Tooo'));
    }
}
