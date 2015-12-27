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

use sys\error\DbConnectionHandlerException;
use sys\helper\Session;
use \PDOException;

/**
 * Controller stands for C of MVC.
 *
 * @author  Gaëtan Masson <gaetanmdev@gmail.com>
 */
abstract class Controller
{
    protected $defaultAction;
    protected $request;
    protected $page;

    /**
     * Constructor.
     */
    protected function __construct()
    {
        $this->defaultAction = 'index';
        $this->page = new Page;
    }

    /**
     * Orders to the page instance to display his view
     *
     * @param string $title
     * @param string $view
     */
    protected function loadPage($title = null, $view = null)
    {
        if (isset($title) and isset($view))
        {
            $this->page->setTitle($title);
            $this->page->setView($view);
        }

        $this->page->display();
    }

    /**
     * Orders to the DbConnectionHandler to create a PDO instance. This function can be used 
     * when two or more connections need to be etablished in the same controller function.
     *
     * @param string $dbInfoKey
     *
     * @throws DbConnectionHandlerException
     * @throws PDOException
     */
    protected function connectDb($dbInfoKey = null)
    {
        try
        {
            DbConnectionHandler::createPDOInstance($dbInfoKey);
        }

        catch(DbConnectionHandlerException $e)
        {
            ExceptionHandler::displayException($e);
        }

        catch(PDOException $e)
        {
            ExceptionHandler::displayException($e);
        }
    }

    /**
     * Orders to the Router to redirect to the specified uri.
     *
     * @param string $uri
     * @param int    $time
     */
    protected function redirect($uri, $time = null)
    {
        Router::redirect($uri, $time);
    }

    /**
     * Orders to the Session class to create an access.
     *              
     * @param string $controller
     * @param string $action
     */
    protected function createAccess($controller, $action = null)
    {
        Session::createAccess($controller, $action);
    }

    /**
     * Orders to the Session class to delete an access.
     *              
     * @param string $controller
     * @param string $action
     */
    protected function deleteAccess($controller, $action = null)
    {
        Session::deleteAccess($controller, $action);
    }

    /**
     * Sets the request.
     *              
     * @param Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * Return the default action.
     *              
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->defaultAction;
    }
}