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
use sys\error\UploadedFileException;

/**
 * Request.
 *
 * @author  Gaëtan Masson <gaetanmdev@gmail.com>
 */
class UploadedFile
{
    private $name;
    private $type;
    private $tmpName;
    private $error;
    private $size;
    private $extension;

    /**
     * Constructor
     */
    public function __construct($file)
    {
        $info = pathinfo($file['name']);

        if ($file['error'] === 4) $this->isValid = false;
        else $this->isValid = true;

        $this->name      = $info['filename'];
        $this->type      = $file['type'];
        $this->tmpName   = $file['tmp_name'];
        $this->error     = $file['error'];
        $this->size      = $file['size'];
        $this->extension = $info['extension'];
    }

    /**
     * Upload the file on the target directory.
     *
     * @param integer $maxSize
     * @param array   $type
     * @param string  $targetDir
     *
     * @throws UploadedFileException
     */
    public function upload($maxSize, $type, $targetDir)
    {
        if (!is_dir($targetDir)) throw new UploadedFileException('The input dir doesn\'t exist ('.$targetDir.' given)', 1);

        if ($this->size <= $maxSize)
        {
            if (in_array($this->type, $type))
            {
                $files = scandir($targetDir);

                if (!in_array($this->name.'.'.$this->extension, $files))
                    move_uploaded_file($this->tmpName, $targetDir.DIRECTORY_SEPARATOR.$this->name.'.'.$this->extension);

                else throw new UploadedFileException('The name of the file is already in use', 2);
            }

            else throw new UploadedFileException('Unsupported extension', 3);
        }

        else throw new UploadedFileException('File size limit exceeded', 4);
    }

    /**
     * Gets the file extension.
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Gets the file type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Gets the file name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the file error.
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Gets the isValid value.
     *
     * @return string
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * Sets the file name.
     *
     * @return string
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
