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
 * This file contains CaPHPy configuration data.
 */

/**
 * The absolute path to allow public data (css, img etc.) to be loaded.
 */
define('ROOT_DIR', 'http://127.0.0.1/caphpy');

/**
 * In production mode, a 500 or 400 error page is loaded and
 * the error is wrote into the log file when an error occurs.
 */
define('PRODUCTION_MODE', false);
