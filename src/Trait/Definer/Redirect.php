<?php

namespace SimpleRouter\Trait\Definer;

/**
 * 受け取ったリクエストに対して行うリダイレクト処理で扱う情報を管理する
 * 
 * @package SimpleRouter\Trait\Definer
 */
trait Redirect
{
    /**
     * リダイレクト先のURL
     * 
     * @var string
     */
    protected string $redirectUrl = "";


    /**
     * リダイレクト時のステータスコード
     * 
     * @var int
     */
    protected int $redirectStatusCode = 302;


    /**
     * リダイレクト先のURLとステータスコードを設定する
     * 
     * @param string $url
     * @param int $statusCode
     * @return static
     */
    public function redirect(string $url, int $statusCode = 302): static
    {
        $this->redirectUrl        = $url;
        $this->redirectStatusCode = $statusCode;

        return $this;
    }
}
