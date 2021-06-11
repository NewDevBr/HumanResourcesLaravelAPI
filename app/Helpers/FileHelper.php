<?php

namespace App\Helpers;

class FileHelper
{

    public static function save($request)
    {
        if($request->hasFile("img") && $request->file("img")->isValid())
        {
            $fileName = self::generateFileName($request->file('img'));
            $pathPhoto = self::upload($request->file("img"), $fileName);
            return $pathPhoto;
        }
    }

    public static function generateFileName($file)
    {
        $name = uniqid(date('HisYmd'));
        $extension = $file->extension();
        $fileName = "{$name}.{$extension}";
        return $fileName;
    }

    public static function upload($file, $fileName)
    {
        $upload = $file->storeAs('public/photos', $fileName);
        $filePath = "storage" .DIRECTORY_SEPARATOR. "photos" .DIRECTORY_SEPARATOR. $fileName;
        if(!$upload)
        {
            unlink($filePath);
            return response()->json(["message"=>"Some error occurred with image upload"], 500);
        }
        return $filePath;
    }

    public static function getFilePath($storedPath)
    {
        return str_replace('\\','/', $storedPath);
    }
}