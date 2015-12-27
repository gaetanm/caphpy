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

namespace sys\core;

use sys\error\DispatcherException;
use sys\helper\Session;

/**
* Dispatcher.
*
* @author  Gaëtan Masson <gaetanmdev@gmail.com>
*/
class Dispatcher
{
    /**
     * Checks if access session exists.
     */
    private static function checkAccessSession($controller, $action)
    {
        try
        {
            if (Session::exists(strtolower(get_class($controller)))
            or Session::exists(strtolower(get_class($controller).'-'.$action))) $controller->$action();

            else $controller->authError();
        }

        catch(MissingRessourceException $e)
        {
            throw $e;
        }
    }

    /**
     * Checks if the input action is a securised action.
     *              
     * @param mixed  $controller
     * @param string $action
     */
    private static function parseSecurisedController($controller, $action)
    {
        if (is_array($controller->getSecurisedAction()))
        {
            if (in_array($action, $controller->getSecurisedAction())) self::checkAccessSession($controller, $action);
            else $controller->$action();
        }

        else
        {
            if ($controller->getSecurisedAction() === $action) self::checkAccessSession($controller, $action);
            else $controller->$action();
        }
    }

    /**
     * Creates a controller instance.
     *              
     * @param string $controllerName
     * 
     * @return mixed
     *
     * @throws DispatcherException
     */
    public static function createController($controllerName)
    {
        $controllerName = 'app\\controller\\'.$controllerName;

        if (!class_exists($controllerName))
            throw new DispatcherException('Dispatcher error: The '.$controllerName.' controller doesn\'t exist');

        return new $controllerName();
    }

    /**
     * Performs the request.
     *
     * @param Request $request
     *
     * @throws DispatcherException
     * @throws MissingRessourceException
     */
    public static function dispatch($request)
    {
        try
        {
            $controller = self::createController($request->getController());
        }

        catch(DispatcherException $e)
        {
            ExceptionHandler::displayException($e);
        }

        $action = $request->getAction();

        if ($action === null) $action = $controller->getDefaultAction();

        if (!method_exists($controller, $action)) 
            throw new DispatcherException('Dispatcher error: The '.$action.' method doesn\'t exist');

        $rController = new \ReflectionClass(get_class($controller));
        $method = $rController->getMethod($action);

        if (!$method->isPublic()) throw new DispatcherException('Dispatcher error: The '.$action.' method is private');

        $controller->setRequest($request);

        if (in_array('sys\core\SController', class_parents($controller))) 
            self::parseSecurisedController($controller, $action);

        else 
        {
            try
            {
                $controller->$action();
            }

            catch(MissingRessourceException $e)
            {
                throw $e;
            }
        }
    }
}