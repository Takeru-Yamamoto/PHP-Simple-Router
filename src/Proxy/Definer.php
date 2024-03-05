<?php

namespace SimpleRouter\Proxy;

use StaticProxy\StaticProxy;

use SimpleRouter\Proxy\DefinerManager;

/**
 * DefinerのProxy
 * DefinerManagerのMethodをstaticに呼び出せるようにする
 * 
 * @package SimpleRouter\Proxy
 * 
 * @method static \SimpleRouter\Definer get(string $path)
 * @method static \SimpleRouter\Definer post(string $path)
 * @method static \SimpleRouter\Definer put(string $path)
 * @method static \SimpleRouter\Definer delete(string $path)
 * 
 * @see \SimpleRouter\Proxy\Interface\ManagerInterface
 */
class Definer extends StaticProxy
{
    /** 
     * DefinerManagerの実クラス名を取得する
     * 
     * @return string 
     */
    public static function getRealInstanceName(): string
    {
        return DefinerManager::class;
    }
}
