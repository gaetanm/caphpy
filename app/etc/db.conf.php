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

/**
 * This file contains database information.
 *
 * If you want to use several databases, you have to create
 * a new key in $dbInfo and to fill in your database information.
 *
 * Ex:
 *
 * $dbInfo['backup']['driver']  = 'pgsql';
 * $dbInfo['backup']['host']    = '127.0.0.10';
 * etc.
 */

$dbInfo['main']['driver']   = 'mysql';
$dbInfo['main']['host']     = '127.0.0.1';
$dbInfo['main']['db']       = 'caphpy';
$dbInfo['main']['usr']      = 'root';
$dbInfo['main']['pwd']      = 'root';
