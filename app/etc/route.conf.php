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
 * This file contains all the framework routes.
 *
 * The route having 'default' as uri SHOULD NOT be deleted, it's the default route called
 * when there is no uri specified in the request.
 *
 * To add a new route:
 *
 * $routingTable[] = new Route('blog/entry', 'Entry', 'index'));
 *
 *
 * To add a new route with get parameters:
 *
 * $routingTable[] = new Route('blog/entry/$', 'Entry', 'view', array('id')));
 *
 *
 * You can also add a route with get parameters having a default value:
 *
 * $routingTable[] = new Route('blog/main/', 'Entry', 'view', array('category' => 0)));
 */

use sys\core\Route;

$routingTable[] = new Route('default', 'Welcome', 'index');
