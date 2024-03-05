<?php

namespace SimpleRouter\Trait\Definer;

/**
 * 設定された情報を基にルーティングに使用する木構造の作成処理を管理する
 * 
 * @package SimpleRouter\Trait\Definer
 * 
 * @property-read string $path
 * @property-read string $httpMethod
 * 
 * @property-read string $className
 * @property-read string $classMethodName
 * 
 * @property-read string $htmlFilePath
 * 
 * @property-read string $phpFilePath
 * @property-read string $phpFileFunctionName
 * 
 * @property-read string $redirectUrl
 * @property-read int $redirectStatusCode
 */
trait MakeTree
{
    /**
     * ルーティングに使用する木構造を作成する
     * 
     * @return array
     */
    public function tree(): array
    {
        return [
            $this->httpMethod => $this->branch(),
        ];
    }

    /**
     * ルーティングに使用する木構造の枝を作成する
     * 
     * @throws \RuntimeException
     * @return array
     */
    protected function branch(): array
    {
        // パスがスラッシュだけの場合は葉を作成する
        if ($this->path === "/") return [
            "/" => $this->leaf(),
        ];

        // パスを扱いやすいように変換する
        $path = $this->moldPath($this->path);

        // パスの各要素をルーティングに使用する木構造の枝に変換する
        $branch = array_reduce($path, function ($carry, $item) {
            // itemが空文字の場合は例外を投げる
            if ($item === "") throw new \RuntimeException("The path includes an empty string.");

            return [
                "/{$item}" => $carry,
            ];
        }, $this->leaf());

        // ルーティングに使用する木構造の枝を返す
        return $branch;
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
     * ルーティングに使用する木構造の葉を作成する
     * 
     * @throws \RuntimeException
     * @return array
     */
    protected function leaf(): array
    {
        return match (true) {
            // 呼び出すクラス名とメソッド名が設定されている場合
            !empty($this->className) && !empty($this->classMethodName) => $this->classMethodLeaf(),

            // 呼び出すPHPファイルのパスが設定されている場合
            !empty($this->phpFilePath) => $this->phpFileLeaf(),

            // 呼び出すHTMLファイルのパスが設定されている場合
            !empty($this->htmlFilePath) => $this->htmlFileLeaf(),

            // リダイレクト先のURLが設定されている場合
            !empty($this->redirectUrl) => $this->redirectLeaf(),

                // それ以外の場合は例外を投げる
            default => throw new \RuntimeException("The routing information is not set."),
        };
    }

    /**
     * クラスメソッドを呼び出すための木構造の葉を作成する
     * 
     * @return array
     */
    protected function classMethodLeaf(): array
    {
        $leaf = [];

        $leaf["type"]   = "class";
        $leaf["class"]  = $this->className;
        $leaf["method"] = $this->classMethodName;

        return $leaf;
    }

    /**
     * PHPファイルを呼び出すための木構造の葉を作成する
     * 
     * @return array
     */
    protected function phpFileLeaf(): array
    {
        $leaf = [];

        $leaf["type"] = "php";
        $leaf["file"] = $this->phpFilePath;

        if (!empty($this->phpFileFunctionName)) $leaf["function"] = $this->phpFileFunctionName;

        return $leaf;
    }

    /**
     * HTMLファイルを呼び出すための木構造の葉を作成する
     * 
     * @return array
     */
    protected function htmlFileLeaf(): array
    {
        $leaf = [];

        $leaf["type"] = "html";
        $leaf["file"] = $this->htmlFilePath;

        return $leaf;
    }

    /**
     * リダイレクト処理を行うための木構造の葉を作成する
     * 
     * @return array
     */
    protected function redirectLeaf(): array
    {
        $leaf = [];

        $leaf["type"] = "redirect";
        $leaf["url"]  = $this->redirectUrl;

        if (!empty($this->redirectStatusCode)) $leaf["status"] = $this->redirectStatusCode;

        return $leaf;
    }
}
