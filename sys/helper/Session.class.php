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

namespace sys\helper;

class Session
/**
* @author  Gaëtan Masson <gaetanmdev@gmail.com>
*/
{
    public static function start()
    {
        session_start();
    }
    
    public static function create($id, $value)
    {
        $_SESSION[$id] = $value;
    }

    public static function set($id, $value)
    {
        $_SESSION[$id] = $value;
    }

    public static function delete($data)
    {
        if (is_array($data))
        {
            foreach($data as $id)
            {
                unset($_SESSION[$id]);
            }
        }

        else unset($_SESSION[$id]);
    }

    public static function exists($id)
    {
        if (isset($_SESSION[$id]))
        {
            return true;
        }

        else return false;
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function getValue($id)
    {
        return $_SESSION[$id];
    }

    public static function createAccess($controller, $action = null)
    {
    	if ($action === null)
    	{
    		$_SESSION[strtolower('app\\controller\\'.$controller)] = true;
    	}

    	else $_SESSION[strtolower('app\\controller\\'.$controller.'-'.$action)] = true;
    }

    public static function deleteAccess($controller, $action = null)
    {
        if ($action === null)
        {
            unset($_SESSION[strtolower('app\\controller\\'.$controller)]);
        }

        else unset($_SESSION[strtolower('app\\controller\\'.$controller.'-'.$action)]);
    }
}