<?php

namespace App\Helpers;

class FileHelper
{
    public static function save($request, $whereSave)
    {
        if($request->hasFile("img") && $request->file("img")->isValid())
        {
            $fileName = self::generateFileName($request->file('img'));
            $pathPhoto = self::upload($request->file("img"), $fileName, $whereSave);
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

    public static function upload($file, $fileName, $whereSave)
    {
        $upload = $file->storeAs($whereSave, $fileName);
        $filePath = "storage" .DIRECTORY_SEPARATOR. "admins" .DIRECTORY_SEPARATOR. $fileName;
        if(!$upload)
        {
            unlink($filePath);
            return response()
                ->json([
                    "msg"=>"Some error occurred with image upload",
                    "sucess"=>false
                ],
                500
            );
        }
        return $filePath;
    }
}