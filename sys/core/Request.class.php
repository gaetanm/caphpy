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
 * Request.
 *
 * @author  Gaëtan Masson <gaetanmdev@gmail.com>
 */
class Request
{
    private $controller;
    private $action;
    private $data;

    /**
     * Constructor.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     * @param array  $data
     */
    public function __construct($controller, $action, $data)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->data = $data;
    }

    /**
     * Gets the controller name.
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Gets the action name.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Checks if the HTTP request send is of ajax type.
     *
     * @return bool
     */
    public function isAjax()
    { 
        if (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            return true;
        else
            return false;
    }

    /**
     * Gets the target data.
     *
     * @return mixed
     */
    public function getData($type, $key)
    {
        if ($type === 'file') return new UploadedFile($this->data['file'][$key]);
        if (!$this->hasData($type, $key)) return null;
        else return $this->data[$type][$key];
    }

    /**
     * Checks if the target data exists.
     *
     * @return bool
     */
    public function hasData($type, $key)
    {
        if (!empty($this->data[$type][$key])) return true;
        else return false;
    }
}