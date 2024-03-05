<?php

namespace SimpleRouter\Proxy;

use SimpleRouter\Proxy\Interface\ManagerInterface;

use SimpleRouter\Definer;

/**
 * Proxyを経由してstaticにアクセスされるManager
 * 
 * @package SimpleRouter\Proxy
 */
class DefinerManager implements ManagerInterface
{
    /**
     * Definerのインスタンスを生成する
     * 
     * @param string $path
     * @param string $method
     * @return \SimpleRouter\Definer
     */
    protected function make(string $path, string $method): Definer
    {
        return new Definer($path, $method);
    }

    /**
     * GETメソッドを適応したDefinerのインスタンスを生成する
     *
     * @param string $path
     * @return \SimpleRouter\Definer
     */
    public function get(string $path): Definer
    {
        return $this->make($path, "GET");
    }

    /**
     * POSTメソッドを適応したDefinerのインスタンスを生成する
     *
     * @param string $path
     * @return \SimpleRouter\Definer
     */
    public function post(string $path): Definer
    {
        return $this->make($path, "POST");
    }

    /**
     * PUTメソッドを適応したDefinerのインスタンスを生成する
     *
     * @param string $path
     * @return \SimpleRouter\Definer
     */
    public function put(string $path): Definer
    {
        return $this->make($path, "PUT");
    }

    /**
     * DELETEメソッドを適応したDefinerのインスタンスを生成する
     *
     * @param string $path
     * @return \SimpleRouter\Definer
     */
    public function delete(string $path): Definer
    {
        return $this->make($path, "DELETE");
    }
}
