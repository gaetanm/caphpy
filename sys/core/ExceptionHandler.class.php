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

use sys\error\MissingRessourceException;
use sys\error\RouterException;
use sys\error\DispatcherException;
use sys\error\PageException;
use \PDOException;

/**
 * ExceptionHandler.
 *
 * @author  Gaëtan Masson <gaetanmdev@gmail.com>
 */
class ExceptionHandler
{
    const SYS_ERROR_VIEW      = 'sys/view/sys-error.view.php';
    const SERV_500_ERROR_VIEW = 'sys/view/500-error.view.php';
    const SERV_404_ERROR_VIEW = 'sys/view/404-error.view.php';

    const PRODUCTION_MODE     = PRODUCTION_MODE; // sys.conf.php

    /**
     * Calls the display function depending on the PRODUCTION_MODE value.
     *
     * @param  array $exception
     */
    public static function displayException($exception)
    {
        if (self::PRODUCTION_MODE === false) self::displaySystemError($exception);
        else self::displayServerError($exception);
        exit();
    }

    /**
     * Displays an error by including sys-error.view.php or showing directely the exception message.
     *
     * @param  array $exception
     */
    private static function displaySystemError($exception)
    {
        $errorMessage = $exception->getMessage();

        if (empty($errorMessage)) $errorMessage = 'The page you are looking for does not exist';

        if ($exception instanceof PDOException) $errorMessage = 'PDO error: '.$exception->getMessage();

        include(self::SYS_ERROR_VIEW);
    }

    /**
     * Includes 500-error.view.php or 404-error.view.php depending on the exception type.
     *
     * @param  array $exception
     */
    private static function displayServerError($exception)
    {
        $errorMessage = $exception->getMessage();

        if ($exception instanceof RouterException or $exception instanceof MissingRessourceException) include(self::SERV_404_ERROR_VIEW);

        else
        {
            if ($exception instanceof PDOException) $errorMessage = 'PDO error: '.$exception->getMessage();

            include(self::SERV_500_ERROR_VIEW);
        }

        self::logException($errorMessage);
    }

    /**
     * Writes exception message into the log file.
     *
     * @param  string $errorMessage
     */
    private static function logException($errorMessage)
    {
        $file = fopen('sys/log/log.txt','a+');
        $errorMessage = date('Y-m-j H:i:s').': '.$errorMessage."\r";

        fwrite($file, $errorMessage);
        fclose($file);
    }
}