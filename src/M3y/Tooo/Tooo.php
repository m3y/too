<?php
namespace M3y\Tooo;

/**
 * To object-oriented.
 */
class Tooo
{
    /**
     * 関数の実行。
     *
     * phpに定義されている関数をオブジェクトのメソッドとして利用できるようにする。<br />
     * ただし、値渡しで実行される関数のみ。
     *
     * @throws BadFunctionCallException if the function is not defined
     * @throws InvalidArgumentException if the arguments is passed by reference
     * @param  string $name      関数名
     * @param  array  $arguments 関数の引数
     * @return mixed  実行結果
     */
    public function __call($name, $arguments)
    {
        if (!function_exists($name)) {
            throw new \BadFunctionCallException("undefined function. [$name]");
        }

        $reflectionFunction = new \ReflectionFunction($name);
        $reflectionParameters = $reflectionFunction->getParameters();

        foreach ($reflectionParameters as $parameter) {
            if ($parameter->isPassedByReference()) {
                throw new \InvalidArgumentException(
                    'sorry, it does not support the use of pass-by-reference.'
                );
            }
        }

        return $reflectionFunction->invokeArgs($arguments);
    }

    public function hasPassedByReference(\ReflectionFunction $reflectionFunction)
    {
        $reflectionParameters = $reflectionFunction->getParameters();
        foreach ($reflectionParameters as $parameter) {
            if ($parameter->isPassedByReference()) {
                return true;
            }
        }

        return false;
    }
    }
}
