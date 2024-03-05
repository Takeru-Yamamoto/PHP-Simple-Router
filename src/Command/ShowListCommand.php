<?php

namespace SimpleRouter\Command;

use SimpleCli\BaseCommand;

class ShowListCommand extends BaseCommand
{
    /**
     * コマンド名
     * 
     * @var string
     */
    protected string $commandName = "show:list";

    /**
     * コマンドの説明文
     * 
     * @var string
     */
    protected string $description = "定義済みのルート一覧を表示します。";


    /**
     * 実行する処理
     * 
     * @return void
     */
    protected function execute(): void
    {
    }
}
