<?php

namespace SimpleRouter;

use SimpleRouter\Interface\MakerInterface;

use SimpleRouter\Trait\Maker\AddDefiner;

/**
 * ルート定義を保持し、木構造を作成するためのクラス
 * 
 * @package SimpleRouter
 */
class Maker implements MakerInterface
{
    use AddDefiner;
}
