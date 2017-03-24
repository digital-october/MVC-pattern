<?php

namespace Core\Libraries;

class AcResizeImage
{
    private $image; //идентификатор самого изображения
    private $width; //исходная ширина
    private $height; //исходная высота
    private $type; //тип изображения (jpg, png, gif)


    function __construct($file)
    {
        if (@!file_exists($file)) exit("File does not exist");
        if (!$this->setType($file)) exit("File is not an image");
        $this->openImage($file);
        $this->setSize();
    }


//функция проверяет, является ли файл изображением и устанавливает его тип
    private function setType($file)
    {
        $mime = mime_content_type($file);
        switch ($mime) {
            case 'image/jpeg':
                $this->type = "jpg";
                return true;
            case 'image/png':
                $this->type = "png";
                return true;
            case 'image/gif':
                $this->type = "gif";
                return true;
            default:
                return false;
        }
    }


//создаёт в зависимости от типа на основе файла идентификатор изображения
    private function openImage($file)
    {
        switch ($this->type) {
            case 'jpg':
                $this->image = @imagecreatefromjpeg($file);
                break;
            case 'png':
                $this->image = @imagecreatefrompng($file);
                break;
            case 'gif':
                $this->image = @imagecreatefromgif($file);
                break;
            default:
                exit("File is not an image");
        }
    }


//устанавливает размеры изображения
    private function setSize()
    {
        $this->width = imagesx($this->image);
        $this->height = imagesy($this->image);
    }


    function resize($width = false, $height = false)
    {
        /**
         * В зависимости от типа ресайза, запишем в $newSize новые размеры изображения.
         */
        if (is_numeric($width) && is_numeric($height) && $width > 0 && $height > 0) {
            $newSize = $this->getSizeByFramework($width, $height);
        } else if (is_numeric($width) && $width > 0) {
            $newSize = $this->getSizeByWidth($width);
        } else if (is_numeric($height) && $height > 0) {
            $newSize = $this->getSizeByHeight($height);
        } else $newSize = array($this->width, $this->height);
//создаём новое пустое изображение
        $newImage = imagecreatetruecolor($newSize[0], $newSize[1]);
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $newSize[0], $newSize[1], $this->width, $this->height);
        $this->image = $newImage;
        $this->setSize();
        return $this;
    }


    private function getSizeByFramework($width, $height)
    {
        if ($this->width <= $width && $this->height <= height)
            return array($this->width, $this->height);
        if ($this->width / $width > $this->height / $height) {
            $newSize[0] = $width;
            $newSize[1] = round($this->height * $width / $this->width);
        } else {
            $newSize[1] = $height;
            $newSize[0] = round($this->width * $height / $this->height);
        }
        return $newSize;
    }


    private function getSizeByWidth($width)
    {
        if ($width >= $this->width) return array($this->width, $this->height);
        $newSize[0] = $width;
        $newSize[1] = round($this->height * $width / $this->width);
        return $newSize;
    }


    private function getSizeByHeight($height)
    {
        if ($height >= $this->height) return array($this->width, $this->height);
        $newSize[1] = $height;
        $newSize[0] = round($this->width * $height / $this->height);
        return $newSize;
    }


    function save($path = '', $fileName, $type = false, $rewrite = false, $quality = 100)
    {
        if (trim($fileName) == '' || $this->image === false) return false;
        $type = strtolower($type);
        switch ($type) {
            case false:
                $savePath = $path . trim($fileName) . "." . $this->type;
                switch ($this->type) {
                    case 'jpg':
                        if (!$rewrite && @file_exists($savePath)) return false;
                        if (!is_numeric($quality) || $quality < 0 || $quality > 100) $quality = 100;
                        imagejpeg($this->image, $savePath, $quality);
                        return $savePath;
                    case 'png':
                        if (!$rewrite && @file_exists($savePath)) return false;
                        imagepng($this->image, $savePath);
                        return $savePath;
                    case 'gif':
                        if (!$rewrite && @file_exists($savePath)) return false;
                        imagegif($this->image, $savePath);
                        return $savePath;
                    default:
                        return false;
                }
                break;
            case 'jpg':
                $savePath = $path . trim($fileName) . "." . $type;
                if (!$rewrite && @file_exists($savePath)) return false;
                if (!is_numeric($quality) || $quality < 0 || $quality > 100) $quality = 100;
                imagejpeg($this->image, $savePath, $quality);
                return $savePath;
            case 'png':
                $savePath = $path . trim($fileName) . "." . $type;
                if (!$rewrite && @file_exists($savePath)) return false;
                imagepng($this->image, $savePath);
                return $savePath;
            case 'gif':
                $savePath = $path . trim($fileName) . "." . $type;
                if (!$rewrite && @file_exists($savePath)) return false;
                imagegif($this->image, $savePath);
                return $savePath;
            default:
                return false;
        }
    }
}