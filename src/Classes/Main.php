<?php

namespace Classes;


use Silex\Application;
use Silex\Application\TwigTrait;
use traits\Utilities;


class Main extends Application
{
    use Utilities;
    use TwigTrait;   
    
}