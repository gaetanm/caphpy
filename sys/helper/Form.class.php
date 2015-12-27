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
 * GNU General Public static License for more details.
 *
 * You should have received a copy of the GNU General Public static License
 * along with CaPHPy.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace sys\helper;

class Form extends HtmlRenderer
/**
* Form generates html form tags.
*
* @author  Gaëtan Masson <gaetanmdev@gmail.com>
*/
{
    const ENC_MULTIPART = 'multipart/form-data';
    const ENC_TEXT = 'text/plain';

    public static function start($uri, array $property = null)
    {
        ((empty($uri)) ? $uri = "" : $uri = ROOT_DIR.'/'.$uri);

        if ($property === null) $html = '<form action="'.$uri.'" method="post">';

        else
        {
            $attributes = self::parseProperty($property);
            if (!array_key_exists('method', $property)) $html = '<form action="'.$uri.'" method="post"'.$attributes.'>';
            else $html = '<form action="'.$uri.'"'.$attributes.'>';
        }

        return $html;
    }

    public static function end()
    {
        return '</form>';
    }
}