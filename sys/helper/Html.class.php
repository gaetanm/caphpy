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

class Html extends HtmlRenderer
/**
* Html generates html tags.
*
* @author  Gaëtan Masson <gaetanmdev@gmail.com>
*/
{
    const JS_DIR              = JS_DIR;
    const CSS_DIR             = CSS_DIR;
    const IMG_DIR             = IMG_DIR;

    public static function js($file)
    {
        $href = self::JS_DIR.$file;
        return '<script type="text/javascript" src="'.$href.'.js"></script>';
    }

    public static function outJS($href)
    {
        return '<script type="text/javascript" src="'.$href.'"></script>';
    }

    public static function css($file)
    {
        $href = self::CSS_DIR.$file;
        return '<link rel="stylesheet" href="'.$href.'.css" type="text/css" />';
    }

    public static function outCSS($href)
    {
        return '<link rel="stylesheet" href="'.$href.'" type="text/css" />';
    }

    public static function url($name, $uri, array $property = null)
    {
        if ($property === null)
        {
            if ($uri === 'default') $html = '<a href="'.ROOT_DIR.'/'.'">'.$name.'</a>';
            elseif (preg_match('/#/', $uri)) $html = '<a href="'.$uri.'">'.$name.'</a>';
            else $html = '<a href="'.ROOT_DIR.'/'.$uri.'">'.$name.'</a>';
        }
        
        else 
        {
            $attribute = self::parseProperty($property);
            if ($uri === 'default') $html = '<a href="'.ROOT_DIR.'/'.'"'.$attribute.'>'.$name.'</a>';
            elseif (preg_match('/#/', $uri)) $html = '<a href="'.$uri.'"'.$attribute.'>'.$name.'</a>';
            else $html = '<a href="'.ROOT_DIR.'/'.$uri.'"'.$attribute.'>'.$name.'</a>';
        }

        return $html;
    }

    public static function outUrl($name, $href, array $property = null)
    {
        if ($property === null) $html = '<a href="'.$href.'">'.$name.'</a>';

        
        else 
        {
            $attribute = self::parseProperty($property);
            $html = '<a href="'.$href.'"'.$attribute.'>'.$name.'</a>';
        }

        return $html;
    }

    public static function img($img, array $property = null)
    {
        $src = self::IMG_DIR.$img;

        if ($property === null) $html = '<img src="'.$src.'" />';

        else 
        {
            $attribute = self::parseProperty($property);
            $html = '<img src="'.$src.'"'.$attribute.' />';
        }

        return $html;
    }

    public static function outImg($src, array $property = null)
    {
        if ($property === null) $html = '<img src="'.$src.'" />';

        else 
        {
            $attribute = self::parseProperty($property);
            $html = '<img src="'.$src.'"'.$attribute.' />';
        }

        return $html;
    }
}