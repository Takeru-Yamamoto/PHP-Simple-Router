<?php

namespace SimpleRouter\Trait\Definer;

/**
 * 受け取ったリクエストによって返すPHPファイルを管理する
 * 
 * @package SimpleRouter\Trait\Definer
 */
trait PhpFile
{
    /**
     * 呼び出すPHPファイルのパス
     * 
     * @var string
     */
    protected string $phpFilePath = "";


    /**
     * 呼び出すPHPファイル内の関数名
     * 
     * @var string
     */
    protected string $phpFileFunctionName = "";


    /**
     * PHPファイルのパスとメソッド名を設定する
     * 
     * @param string $path
     * @param string $functionName
     * @return static
     */
    public function php(string $path, string $functionName = ""): static
    {
        $this->phpFilePath         = $path;
        $this->phpFileFunctionName = $functionName;

        return $this;
    }
}
