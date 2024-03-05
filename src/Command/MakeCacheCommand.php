<?php

namespace SimpleRouter\Command;

use SimpleCli\BaseCommand;

use SimpleRouter\EnvLoader;
use SimpleRouter\Maker;

class MakeCacheCommand extends BaseCommand
{
    /**
     * コマンド名
     * 
     * @var string
     */
    protected string $commandName = "make:cache";

    /**
     * コマンドの説明文
     * 
     * @var string
     */
    protected string $description = "定義済みのルートをファイルにキャッシュします。";


    /**
     * 実行する処理
     * 
     * @return void
     */
    protected function execute(): void
    {
        // ルート定義を保持する変数
        $routes = [];

        // EnvLoaderクラスのインスタンスを生成
        $envLoader = new EnvLoader();

        // パスが存在しない場合は例外を出力する
        if (!file_exists($envLoader->routeFileDirectory)) return $this->outputRouteFileDirectoryNotExists($envLoader->routeFileDirectory);

        // ルートファイルのディレクトリ内のファイルを取得
        $routeFiles = glob($envLoader->routeFileDirectory . "/*.php");

        // ルートファイルのディレクトリ内にファイルが存在しない場合は例外を出力する
        if (empty($routeFiles)) return $this->outputRouteFileDirectoryEmpty($envLoader->routeFileDirectory);

        // ルートファイルのディレクトリ内のファイルを読み込む
        foreach ($routeFiles as $routeFile) {
            // ルートファイルの返り値を取得
            $maker = require $routeFile;

            // ルートファイルの返り値がMakerクラスのインスタンスでない場合は例外を出力する
            if (!($maker instanceof Maker)) return $this->outputRouteFileReturnNotMakerInstance($routeFile);

            // ルート定義をマージする
            $routes = array_merge_recursive($routes, $maker->routes());
        }

        // ルート定義をキャッシュする
        file_put_contents($envLoader->routeCacheFilePath(), "<?php return " . var_export($routes, true) . ";");
    }


    /**
     * ルートファイルのディレクトリ内が存在しない場合の出力処理
     * 
     * @param string $routeFileDirectory
     * @return void
     */
    protected function outputRouteFileDirectoryNotExists(string $routeFileDirectory): void
    {
        $this->outputError("Error Caught", true);
        $this->outputError("Route file directory not exists.");
        $this->outputError("Please check the route file directory.");
        $this->outputError("Route file directory: " . realpath($routeFileDirectory));
    }

    /**
     * ルートファイルのディレクトリ内にファイルが存在しない場合の出力処理
     * 
     * @param string $routeFileDirectory
     * @return void
     */
    protected function outputRouteFileDirectoryEmpty(string $routeFileDirectory): void
    {
        $this->outputError("Error Caught", true);
        $this->outputError("Route file directory is empty.");
        $this->outputError("Please check the route file directory.");
        $this->outputError("Route file directory: " . realpath($routeFileDirectory));
    }

    /**
     * ルートファイルの返り値がMakerクラスのインスタンスでない場合の出力処理
     * 
     * @param string $routeFile
     * @return void
     */
    protected function outputRouteFileReturnNotMakerInstance(string $routeFile): void
    {
        $this->outputError("Error Caught", true);
        $this->outputError("Route file return is not Maker instance.");
        $this->outputError("Please check the route file.");
        $this->outputError("Route file: " . realpath($routeFile));
    }
}
