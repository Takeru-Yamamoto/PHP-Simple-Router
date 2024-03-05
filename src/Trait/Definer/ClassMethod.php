<?php

namespace SimpleRouter\Trait\Definer;

/**
 * 受け取ったリクエストによって呼び出すクラスメソッドを管理する
 * 
 * @package SimpleRouter\Trait\Definer
 */
trait ClassMethod
{
    /**
     * 呼び出すクラス名
     * 
     * @var string
     */
    protected string $className = "";


    /**
     * 呼び出すクラスメソッド名
     * 
     * @var string
     */
    protected string $classMethodName = "";


    /**
     * クラス名とメソッド名を設定する
     * 
     * @param string $className
     * @param string $methodName
     * @return static
     */
    public function method(string $className, string $methodName): static
    {
        $this->className       = $className;
        $this->classMethodName = $methodName;

        return $this;
    }
}
