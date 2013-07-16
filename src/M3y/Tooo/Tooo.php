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
        if ($this->hasPassedByReference($reflectionFunction)) {
            throw new \InvalidArgumentException(
                'sorry, it does not support the use of pass-by-reference.'
            );
        }

        return $reflectionFunction->invokeArgs($arguments);
    }

    /**
     * preg_match.
     */
    public function preg_match($pattern, $subject, array &$matches=array(), $flags=0, $offset=0)
    {
        return preg_match($pattern, $subject, $matches, $flags, $offset);
    }

    /**
     * preg_match_all.
     */
    public function preg_match_all($pattern, $subject, array &$matches=array(), $flags=PREG_PATTERN_ORDER, $offset=0)
    {
        return preg_match_all($pattern, $subject, $matches, $flags, $offset);
    }

    /**
     * 参照渡し引数の確認。
     *
     * @param object ReflectionFunction $reflectionFunction
     * @return bool 確認結果
     */
    private function hasPassedByReference(\ReflectionFunction $reflectionFunction)
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
