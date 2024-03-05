<?php

namespace SimpleRouter\Interface;

use SimpleRouter\Interface\DefinerInterface;

/**
 * DefinerのInterface
 * 
 * @package SimpleRouter\Interface
 */
interface MakerInterface
{
    /*----------------------------------------*
     * Add Definer
     *----------------------------------------*/

    /**
     * ルート定義を取得する
     * 
     * @return array
     */
    public function routes(): array;

    /**
     * Definerを追加する
     * 
     * @param \SimpleRouter\Interface\DefinerInterface $definer
     * @return void
     */
    public function add(DefinerInterface $definer): void;

    /**
     * ルート定義のグループを追加する
     * callbackの引数にはMakerが渡される
     * callbackはMakerのインスタンスを返す必要がある
     * 
     * @param string $path
     * @param callable $callback
     * @throws \RuntimeException
     * @return void
     */
    public function group(string $path, callable $callback): void;
}
