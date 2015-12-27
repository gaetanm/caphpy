<?php

/**
 * Copyright (C) 2013 Gaëtan Masson
 *
 * This file is part of CaPHPy.
 *
 * CaPHPy is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * CaPHPy is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with CaPHPy.  If not, see <http://www.gnu.org/licenses/>.
 */

require('app/etc/sys.conf.php');
require('app/etc/db.conf.php');
require('sys/core/Loader.class.php');

define('DB_INFO', serialize($dbInfo));
define('JS_DIR',  ROOT_DIR.'/app/public/js/');
define('CSS_DIR', ROOT_DIR.'/app/public/css/');
define('IMG_DIR', ROOT_DIR.'/app/public/img/');

use sys\core\Loader;
use sys\core\Dispatcher;
use sys\core\Router;
use sys\core\ExceptionHandler;
use sys\error\MissingRessourceException;
use sys\error\DispatcherException;
use sys\error\RouterException;

Loader::register();

require('app/etc/route.conf.php');

$router = new Router($routingTable);

try
{
    $request = $router->getRequest($_GET, $_POST, $_FILES);

    try
    {
        Dispatcher::dispatch($request);
    }

    catch(DispatcherException $e)
    {
        ExceptionHandler::displayException($e);
    }

    catch(MissingRessourceException $e)
    {
        ExceptionHandler::displayException($e);
    }
}

catch(RouterException $e)
{
    ExceptionHandler::displayException($e);
}