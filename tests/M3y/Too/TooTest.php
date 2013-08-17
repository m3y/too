<?php
namespace M3y\Too\TooTest;

use M3y\Too\Too;

class TooTest extends \PHPUnit_Framework_TestCase
{
    private $object;

    /**
     * setup.
     */
    public function setUp()
    {
        $this->object = new Too;
    }

    /**
     * @test
     */
    public function 値渡しの関数を実行できること_strtoupper()
    {
        // strtoupper
        $expected = strtoupper("Test_Value");
        $this->assertSame($expected, $this->object->strtoupper('Test_Value'));
    }

    /**
     * @test
     */
    public function 値渡しの関数を実行できること_strtolower()
    {
        // strtolower
        $expected = strtolower("tEST_vALUE");
        $this->assertSame($expected, $this->object->strtolower('tEST_vALUE'));
    }

    /**
     * @test
     */
    public function 値渡しの関数を実行できること_array_keys()
    {
        // array_keys
        $sample = array(
            "test_key2" => "hoge",
            "hogehoge",
            "test_key1" => null,
        );

        $expected = array_keys($sample);
        $this->assertSame($expected, $this->object->array_keys($sample));
    }

    /**
     * @test
     * @expectedException BadFunctionCallException
     */
    public function 定義されていない関数を呼ばれた際に例外が投げられること()
    {
        $this->object->undefined();
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 参照渡しの関数の場合、例外が投げられること()
    {
        $array = array();
        $this->object->each($array);
    }
}
