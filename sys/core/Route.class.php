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

/**
 * Route.
 *
 * @author  Gaëtan Masson <gaetanmdev@gmail.com>
 */
class Route
{
    private $uri;
    private $controller;
    private $action;
    private $parameters;

    /**
     * Constructor.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     * @param array  $parameters
     */
    public function __construct($uri, $controller, $action = null, array $parameters = null)
    {
        if (preg_match('#$#', $uri)) $uri = str_replace('$', '[a-z0-9A-Z-]+', $uri);

        $uri = '#^'.$uri.'$#';

        $this->controller = $controller;
        $this->action = $action;
        $this->uri = $uri;
        $this->parameters = $parameters;
    }

    /**
     * Gets the uri.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Gets the controller.
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Gets the action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Gets the param.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}