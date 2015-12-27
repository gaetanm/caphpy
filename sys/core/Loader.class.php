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
 * Loader.
 * 
 * @author Gaëtan Masson <gaetanm@gmail.com>
 */
class Loader
{
    /**
     * Adds loadClass function to spl_autoload_register.
     */
    public static function register()
    {
        spl_autoload_register(array('self', 'loadClass'));
    }

    /**
     * Simply the CaPHPy autoloader.
     *
     * @param string $className
     */
    private static function loadClass($className)
    {
        if(file_exists(str_replace('\\', '/', $className).'.class.php'))
            require(str_replace('\\', '/', $className).'.class.php');
    }
}