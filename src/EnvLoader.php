<?php

namespace SimpleRouter;

use EnvLoader\BaseEnvLoader;

/**
 * SimpleRouterの.envファイルの値を管理するクラス
 * 
 * @package SimpleRouter
 */
class EnvLoader extends BaseEnvLoader
{
    /**
     * key名に共通する接頭後
     * 
     * @var string
     */
    const KEY_PREFIX = "SIMPLE_ROUTER_";



    /*----------------------------------------*
     * Route File Directory
     *----------------------------------------*/

    /**
     * ルートファイルのディレクトリ
     * 
     * @var string
     */
    public string $routeFileDirectory;

    /**
     * ルートファイルのディレクトリのデフォルト値
     * 
     * @var string
     */
    const ROUTE_FILE_DIRECTORY = __DIR__ . "/../../../../../routes";

    /**
     * ルートファイルのディレクトリのkey名
     * 
     * @var string
     */
    const ROUTE_FILE_DIRECTORY_KEY = self::KEY_PREFIX . "ROUTE_FILE_DIRECTORY";



    /*----------------------------------------*
     * Route Cache Directory
     *----------------------------------------*/

    /**
     * ルートキャッシュファイルのディレクトリ
     * 
     * @var string
     */
    public string $routeCacheDirectory;

    /**
     * ルートキャッシュファイルのディレクトリのデフォルト値
     * 
     * @var string
     */
    const ROUTE_CACHE_DIRECTORY = __DIR__ . "/../../../../../routes/cache";

    /**
     * ルートキャッシュファイルのディレクトリのkey名
     * 
     * @var string
     */
    const ROUTE_CACHE_DIRECTORY_KEY = self::KEY_PREFIX . "ROUTE_CACHE_DIRECTORY";



    /*----------------------------------------*
     * Route Cache File Name
     *----------------------------------------*/

    /**
     * ルートキャッシュファイルの名前
     * 
     * @var string
     */
    public string $routeCacheFileName;

    /**
     * ルートキャッシュファイルの名前のデフォルト値
     * 
     * @var string
     */
    const ROUTE_CACHE_FILE_NAME = "route-cache.php";

    /**
     * ルートキャッシュファイルの名前のkey名
     * 
     * @var string
     */
    const ROUTE_CACHE_FILE_NAME_KEY = self::KEY_PREFIX . "ROUTE_CACHE_FILE_NAME";


    /**
     * .envファイルの内容をクラスのプロパティとしてセットする
     * 
     * @return void
     */
    protected function setEnv(): void
    {
        $this->routeFileDirectory  = $this->getEnvString(self::ROUTE_FILE_DIRECTORY_KEY, self::ROUTE_FILE_DIRECTORY);
        $this->routeCacheDirectory = $this->getEnvString(self::ROUTE_CACHE_DIRECTORY_KEY, self::ROUTE_CACHE_DIRECTORY);
        $this->routeCacheFileName  = $this->getEnvString(self::ROUTE_CACHE_FILE_NAME_KEY, self::ROUTE_CACHE_FILE_NAME);
    }


    /**
     * ルート定義のキャッシュファイルのパスを取得する
     * 
     * @return string
     */
    public function routeCacheFilePath(): string
    {
        return "{$this->routeCacheDirectory}/{$this->routeCacheFileName}";
    }
}
