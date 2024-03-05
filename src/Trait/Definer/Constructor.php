<?php

namespace SimpleRouter\Trait\Definer;

/**
 * Definerクラスのコンストラクタを管理する
 * 
 * @package SimpleRouter\Trait\Definer
 */
trait Constructor
{
    /**
     * リクエストのパス
     * 
     * @var string
     */
    protected string $path;

    /**
     * リクエストのメソッド
     * 
     * @var string
     */
    protected string $httpMethod;


    /**
     * コンストラクタ
     * リクエストのパスとメソッドを取得する
     * 
     * @param string $path
     * @param string $httpMethod
     */
    function __construct(string $path, string $httpMethod)
    {
        $this->path       = $path;
        $this->httpMethod = $httpMethod;
    }

    /**
     * リクエストのパスを取得する
     * 
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * リクエストのメソッドを取得する
     * 
     * @return string
     */
    public function httpMethod(): string
    {
        return $this->httpMethod;
    }
}
