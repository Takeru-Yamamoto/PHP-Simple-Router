<?php

namespace SimpleRouter\Interface;

/**
 * DefinerのInterface
 * 
 * @package SimpleRouter\Interface
 */
interface DefinerInterface
{
    /*----------------------------------------*
     * Constructor
     *----------------------------------------*/

    /**
     * リクエストのパスを取得する
     * 
     * @return string
     */
    public function path(): string;

    /**
     * リクエストのメソッドを取得する
     * 
     * @return string
     */
    public function httpMethod(): string;



    /*----------------------------------------*
     * Make Tree
     *----------------------------------------*/

    /**
     * ルーティングに使用する木構造を作成する
     * 
     * @return array
     */
    public function tree(): array;



    /*----------------------------------------*
     * Redirect
     *----------------------------------------*/

    /**
     * リダイレクト先のURLとステータスコードを設定する
     * 
     * @param string $url
     * @param int $statusCode
     * @return static
     */
    public function redirect(string $url, int $statusCode = 302): static;



    /*----------------------------------------*
     * Class Method
     *----------------------------------------*/

    /**
     * クラス名とメソッド名を設定する
     * 
     * @param string $className
     * @param string $methodName
     * @return static
     */
    public function method(string $className, string $methodName): static;



    /*----------------------------------------*
     * HTML File
     *----------------------------------------*/

    /**
     * HTMLファイルのパスを設定する
     * 
     * @param string $path
     * @return static
     */
    public function html(string $path): static;



    /*----------------------------------------*
     * PHP File
     *----------------------------------------*/

    /**
     * PHPファイルのパスとメソッド名を設定する
     * 
     * @param string $path
     * @param string $functionName
     * @return static
     */
    public function php(string $path, string $functionName = ""): static;
}
