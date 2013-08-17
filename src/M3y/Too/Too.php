<?php
namespace M3y\Too;

/**
 * To object.
 *
 * @package M3y\Too
 */
class Too
{
    /**
     * run pass-by-value function.
     *
     * @throws BadFunctionCallException if the function is not defined
     * @throws InvalidArgumentException if the arguments is passed by reference
     * @param  string $functionName
     * @param  array  $arguments
     * @return mixed  execution result
     */
    public function __call($functionName, $arguments)
    {
        if (!function_exists($functionName)) {
            throw new \BadFunctionCallException("undefined function. [$functionName]");
        }

        $reflectionFunction = new \ReflectionFunction($functionName);
        if ($this->hasPassedByReference($reflectionFunction)) {
            throw new \InvalidArgumentException(
                'sorry, it does not support the use of pass-by-reference.'
            );
        }

        return $reflectionFunction->invokeArgs($arguments);
    }

    /**
     * confirmation of pass-by-reference function.
     *
     * @param object ReflectionFunction $reflectionFunction
     * @return bool  confirmation result
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
