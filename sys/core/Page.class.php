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

use sys\error\PageException;

/**
 * Page is the V of MVC.
 *
 * @author  Gaëtan Masson <gaetanmdev@gmail.com>
 */
class Page
{
    const APP_VIEW_DIR = 'app/view/';
    const INC_DIR      = 'app/view/inc/';

    private $title;
    private $view;
    private $data;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->data = array();
    }

    /**
     * Adds data.
     *
     * @param string $key
     * @param mixed  $data
     */
    public function addData($key, $data)
    {
        $this->data[$key] = $data;
    }

    /**
     * Displays the input element.
     *
     * @param string $element
     */
    public function display($element = null)
    {
        if ($element === null) $element = self::APP_VIEW_DIR.$this->view;

        else $element = self::INC_DIR.$element;

        try
        {
            if (!is_file($element))
                throw new PageException('Page error: missing element to display ("'.$element.'" given)');
        }
        
        catch(PageException $e)
        {
            ExceptionHandler::displayException($e);
        }

        include($element);
    }

    /**
     * Checks if the input key exists.
     *
     * @param string $element
     *
     * @return bool
     */
    public function hasData($key)
    {
        if (isset($this->data[$key])) return true;
    }

    /**
     * Sets the title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Sets the view.
     *
     * @param string $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }
}