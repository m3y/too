<?php
namespace M3y\Tooo\ToooTest;

use M3y\Tooo\Tooo;

class ToooTest extends \PHPUnit_Framework_TestCase
{
    private $oo;

    /**
     * setup.
     */
    public function setUp()
    {
        $this->oo = new Tooo;
    }

    /**
     * @test
     */
    public function 値渡しの関数を実行できること_strtoupper()
    {
        // strtoupper
        $expected = strtoupper("Test_Value");
        $this->assertSame($expected, $this->oo->strtoupper('Test_Value'));
    }

    /**
     * @test
     */
    public function 値渡しの関数を実行できること_strtolower()
    {
        // strtolower
        $expected = strtolower("tEST_vALUE");
        $this->assertSame($expected, $this->oo->strtolower('tEST_vALUE'));
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
        $this->assertSame($expected, $this->oo->array_keys($sample));
    }

    /**
     * @test
     * @expectedException BadFunctionCallException
     */
    public function 定義されていない関数を呼ばれた際に例外が投げられること()
    {
        $this->oo->undefined();
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 未対応の参照渡しの関数の場合、例外が投げられること()
    {
        $array = array();
        $this->oo->each($array);
    }
}
