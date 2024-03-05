<?php

namespace SimpleRouter\Trait\Definer;

/**
 * 受け取ったリクエストによって返すHTMLファイルを管理する
 * 
 * @package SimpleRouter\Trait\Definer
 */
trait HtmlFile
{
    /**
     * 呼び出すHTMLファイルのパス
     * 
     * @var string
     */
    protected string $htmlFilePath = "";


    /**
     * HTMLファイルのパスを設定する
     * 
     * @param string $path
     * @return static
     */
    public function html(string $path): static
    {
        $this->htmlFilePath = $path;

        return $this;
    }
}
