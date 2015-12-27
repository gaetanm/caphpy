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

use sys\error\RouterException;

/**
* Router.
*
* @author  Gaëtan Masson <gaetanmdev@gmail.com>
*/
class Router
{
    private $routingTable;

    public function __construct($routingTable)
    {
        $this->routingTable = $routingTable;
    }

    /**
     * Gets the target route depending on the input uri.
     *
     * @param string $uri
     *
     * @throws RouterException
     *
     * @return string
     */
    private function getRoute($uri)
    {
        foreach($this->routingTable as $name => $route)
        {
            if (preg_match($route->getUri(), $uri))
            {
                $route = $route;
                $exist = true;
                break;
            }

            else $exist = false;
        }

        if (!$exist) throw new RouterException('Router error: '.$uri.' uri doesn\'t exist in the routing table');

        return $route;
    }

    /**
     * Gets the request object.
     *
     * @param array $getData
     * @param array $postData
     * @param array $fileData
     *
     * @throws RouterException
     *
     * @return Request
     */
    public function getRequest($getData, $postData, $fileData)
    {
        if (!isset($getData['uri'])) $uri = 'default';
 
        else
        {
            if ($getData['uri'] === 'default') 
                throw new RouterException('Router error: default uri isn\'t accessible via the url');

            elseif (substr($getData['uri'], -1) === '/') $uri = substr($getData['uri'], 0, -1);

            else $uri = $getData['uri'];
        }

        $route = $this->getRoute($uri);
        $routeParameters = $route->getParameters();

        if (!empty($postData) or !empty($routeParameters) or !empty($fileData) or !empty($getData)) 
            $data = $this->mergeParameters($routeParameters, $getData, $postData, $fileData);

        else $data = null;

        return new Request($route->getController(), $route->getAction(), $data);
    }


    /**
     * Merges the parameters.
     *
     * @param array $routeParameters
     * @param array $getData
     * @param array $postData
     * @param array $fileData
     *
     * @return Array
     */
    private function mergeParameters($routeParameters, $getData, $postData, $fileData)
    {
        if ($routeParameters != null)
        {
            $size = 0;
            $index = 0;

            foreach ($routeParameters as $key => $value)
            {
                if (is_int($key)) $size++;
            }

            $values = array_slice(explode('/', $getData['uri']), -$size);

            foreach ($routeParameters as $key => $value) 
            {
                if (is_int($key))
                {
                    $data['get'][$value] = $values[$index];
                    $index++;
                }

                else $data['get'][$key] = $value;
            }
        }
        
        foreach ($getData as $key => $value)
        {
            $data['get'][$key] = $value;
        }

        foreach ($postData as $key => $value)
        {
            $data['post'][$key] = $value;
        }

        foreach ($fileData as $key => $value)
        {
            $data['file'][$key] = $value;
        }

        return $data;
    }

    /**
     * Redirects to the target uri.
     *
     * @param string  $uri
     * @param integer $time
     */
    public static function redirect($uri, $time = null)
    {
        if ($uri === 'default') $uri = null;
        
        if ($time === null) header('Location: '.ROOT_DIR.'/'.$uri.'');

        else header('Refresh: '.$time.';'.ROOT_DIR.'/'.$uri.'');
    }
}