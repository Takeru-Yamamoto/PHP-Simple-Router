<?php

namespace SimpleRouter\Command;

use SimpleCli\BaseCommand;

class ClearCacheCommand extends BaseCommand
{
    /**
     * コマンド名
     * 
     * @var string
     */
    protected string $commandName = "clear:cache";

    /**
     * コマンドの説明文
     * 
     * @var string
     */
    protected string $description = "ルート定義がキャッシュされたファイルを削除します。";


    /**
     * 実行する処理
     * 
     * @return void
     */
    protected function execute(): void
    {
    }
}
