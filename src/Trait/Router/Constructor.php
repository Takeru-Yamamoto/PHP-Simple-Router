<?php

namespace SimpleRouter\Trait\Router;

use SimpleRouter\EnvLoader;

/**
 * Routerクラスのコンストラクタを管理する
 * 
 * @package SimpleRouter\Trait\Router
 */
trait Constructor
{
    /**
     * .envに定義された項目の値を保持するクラス
     * 
     * @var EnvLoader
     */
    protected EnvLoader $env;


    /**
     * コンストラクタ
     */
    function __construct()
    {
        // .envファイルの内容を保持するクラスのインスタンスを生成
        $this->env = new EnvLoader();
    }


    /**
     * ルート定義のキャッシュファイルが存在するかどうかを返す
     * 
     * @return bool
     */
    protected function isCacheFileExists(): bool
    {
        // ルート定義のキャッシュファイルが存在しない場合はfalseを返す
        if (!file_exists($this->env->routeCacheFilePath())) return false;

        // ルート定義のキャッシュを受け取る
        $cache = require $this->env->routeCacheFilePath();

        // ルート定義のキャッシュが配列でない場合はfalseを返す
        if (!is_array($cache)) return false;

        // trueを返す
        return true;
    }
}
