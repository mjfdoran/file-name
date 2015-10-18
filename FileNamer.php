<?php

/**
 * Created by PhpStorm.
 * User: matt.doran
 * Date: 15/08/2015
 * Time: 19:38
 */
class FileNamer
{
    private $additionalValue;

    function __construct()
    {
        $this->additionalValue = '';
    }


    public function getFileName($uploadDirectory, $filename)
    {
        $fullFilePath = $uploadDirectory . $filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $justFilenameWithoutExtension = substr($filename, 0, strrpos( $filename, '.'));
        $fullImagePathWithoutExtension = substr($fullFilePath, 0, strrpos( $fullFilePath, '.'));

        while (file_exists($fullImagePathWithoutExtension . $this->additionalValue . '.' .$extension)) {

            $this->updateAdditionalValue();
        }

        return $justFilenameWithoutExtension .   $this->additionalValue . '.' .$extension;
    }


    private function updateAdditionalValue()
    {
        if ($this->additionalValue == '') {
            $this->additionalValue = 2;
        } else {
            $this->additionalValue ++;
        }
    }
}