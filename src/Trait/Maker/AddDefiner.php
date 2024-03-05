<?php

namespace SimpleRouter\Trait\Maker;

use SimpleRouter\Interface\DefinerInterface;

/**
 * MakerにDefinerを追加する処理を管理する
 * 
 * @package SimpleRouter\Trait\Maker
 */
trait AddDefiner
{
    /**
     * Definerで作成したルート定義
     * 
     * @var array
     */
    protected array $routes = [];


    /**
     * ルート定義を取得する
     * 
     * @return array
     */
    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * Definerを追加する
     * 
     * @param \SimpleRouter\Interface\DefinerInterface $definer
     * @return void
     */
    public function add(DefinerInterface $definer): void
    {
        $this->routes = array_merge_recursive($this->routes, $definer->tree());
    }

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
    public function group(string $path, callable $callback): void
    {
        // パスを扱いやすいように変換する
        $path = $this->moldPath($path);

        // makerのルート定義を取得する
        $routes = $this->runGroupCallback($callback);

        // ルート定義を追加する
        // 各HTTPメソッドに対応するルート定義の先頭にグループのパスを追加する
        $mergedRoutes = [];
        foreach ($routes as $httpMethod => $route) {
            $mergedRoutes[$httpMethod] = array_reduce($path, function ($carry, $item) {
                // itemが空文字の場合は例外を投げる
                if ($item === "") throw new \RuntimeException("The path includes an empty string.");

                return [
                    "/{$item}" => $carry,
                ];
            }, $route);
        }

        // ルート定義をマージする
        $this->routes = array_merge_recursive($this->routes, $mergedRoutes);
    }

    /**
     * pathを扱いやすいように変換する
     * 
     * @param string $path
     * @throws \RuntimeException
     * @return array
     */
    protected function moldPath(string $path): array
    {
        // パスが空文字の場合は例外を投げる
        if ($path === "") throw new \RuntimeException("The path is empty.");

        // パスがスラッシュだけの場合は例外を投げる
        if ($path === "/") throw new \RuntimeException("The path is only slash.");

        // パスの先頭がスラッシュの場合はスラッシュを削除する
        if (str_starts_with($path, "/")) $path = ltrim($path, "/");

        // パスの末尾がスラッシュの場合はスラッシュを削除する
        if (str_ends_with($path, "/")) $path = rtrim($path, "/");

        // パスをスラッシュで分割する
        $path = explode("/", $path);

        // パス配列を逆順にする
        $path = array_reverse($path);

        return $path;
    }

    /**
     * groupのcallbackを実行する
     * 
     * @param callable $callback
     * @return array
     */
    protected function runGroupCallback(callable $callback): array
    {
        // makerを作成する
        $maker = new static();

        // callbackを実行する
        $maker = $callback($maker);

        // makerがMakerクラスのインスタンスでない場合は例外を投げる
        if (!($maker instanceof static)) throw new \RuntimeException("callback must return Maker instance");

        // makerのルート定義を取得する
        $routes = $maker->routes();

        // ルート定義を返す
        return $routes;
    }
}
