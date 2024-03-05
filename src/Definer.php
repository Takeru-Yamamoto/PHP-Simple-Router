<?php

namespace SimpleRouter;

use SimpleRouter\Interface\DefinerInterface;

use SimpleRouter\Trait\Definer\Constructor;
use SimpleRouter\Trait\Definer\MakeTree;

use SimpleRouter\Trait\Definer\Redirect;
use SimpleRouter\Trait\Definer\ClassMethod;
use SimpleRouter\Trait\Definer\HtmlFile;
use SimpleRouter\Trait\Definer\PhpFile;

/**
 * ルーティングを定義するためのクラス
 * 
 * @package SimpleRouter
 */
class Definer implements DefinerInterface
{
    use Constructor;
    use MakeTree;

    use Redirect;
    use ClassMethod;
    use HtmlFile;
    use PhpFile;
}
