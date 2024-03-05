<?php

namespace SimpleRouter;

use SimpleRouter\Interface\RouterInterface;

use SimpleRouter\Trait\Router\Constructor;

/**
 * ルーティングを行うためのクラス
 * 
 * @package SimpleRouter
 */
class Router implements RouterInterface
{
    use Constructor;
}
