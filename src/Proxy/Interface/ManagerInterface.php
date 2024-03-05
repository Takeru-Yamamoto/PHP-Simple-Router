<?php

namespace SimpleRouter\Proxy\Interface;

use SimpleRouter\Interface\DefinerInterface;

/**
 * Proxyを経由してstaticにアクセスされるManagerのInterface
 * 
 * @package SimpleRouter\Proxy\Interface
 */
interface ManagerInterface
{
    /**
     * GETメソッドを適応したDefinerのインスタンスを生成する
     *
     * @param string $path
     * @return \SimpleRouter\Interface\DefinerInterface
     */
    public function get(string $path): DefinerInterface;

    /**
     * POSTメソッドを適応したDefinerのインスタンスを生成する
     *
     * @param string $path
     * @return \SimpleRouter\Interface\DefinerInterface
     */
    public function post(string $path): DefinerInterface;

    /**
     * PUTメソッドを適応したDefinerのインスタンスを生成する
     *
     * @param string $path
     * @return \SimpleRouter\Interface\DefinerInterface
     */
    public function put(string $path): DefinerInterface;

    /**
     * DELETEメソッドを適応したDefinerのインスタンスを生成する
     *
     * @param string $path
     * @return \SimpleRouter\Interface\DefinerInterface
     */
    public function delete(string $path): DefinerInterface;
}
