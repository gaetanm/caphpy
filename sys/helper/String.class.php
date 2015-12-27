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

class String
/**
* @author  Gaëtan Masson <gaetanmdev@gmail.com>
*/
{
    public static function isMail($string)
    {
        if (preg_match('#^[a-zA-Z0-9-._]+@[a-zA-Z0-9-.]+.[a-z]$#', $string)) return true;
        else return false;
    }

    public static function cleanBefore($string, $stripTags = true, $authorized = null)
    {
        if ($stripTags) return nl2br(addslashes(strip_tags($string, $authorized)));
        else return nl2br(addslashes($string));
    }

    public static function cleanAfter($string)
    {
        return stripslashes($string);
    }

    public static function displayUrl($string)
    {
        $search = array("/([\w\.\/\&\=\?\-]+)@([\w\.\/\&\=\?\-]+)/",
            "/((ftp(7?):\/\/)|(ftp\.))([\w\.\/\&\=\?\-]+)/",
            "/((http(s?):\/\/)|(www\.))([\w\.\/\&\=\?\-]+)/" );

        $replace = array("<a href='mailto:$1@$2'>$1@$2</a>",
            "<a href='ftp$3://$4$5' target='_blank'>$4$5</a>",
            "<a href='http$3://$4$5' target='_blank'>$4$5</a>" );

        return stripslashes(preg_replace($search, $replace, $string));
    }

    //public static function slug($string){}

    public static function preview($charNumber, $string)
    {
        substr($string, 0, $charNumber);
    }
}