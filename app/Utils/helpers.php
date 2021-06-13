<?php

if (!function_exists('storeFile')) {
    /**
     * Store file from request
     *
     * @param Illuminate\Http\Request $request
     * @param String $requestName
     * @param String $path
     * @return String $filename
     */
    function storeFile(Illuminate\Http\Request $request, $requestName, $path = '/uploads')
    {
        try {
            if ($request->hasFile($requestName)) {
                $file = $request[$requestName];
                $image = $file->getClientOriginalName();
                $destinationPath = public_path($path);
                $name = pathinfo($image, PATHINFO_FILENAME);
                $ext = pathinfo($image, PATHINFO_EXTENSION);
                $filename = $name . '_' . date('dmyhis') . '.' . $ext;
                $file->move($destinationPath, $filename);
                return $filename;
            }
            throw new Exception('Request of object not found');
        } catch (\Throwable $th) {
            return $th;
        }
    }
}

if (!function_exists('removeFile')) {
    /**
     * Helper for removing file
     *
     * @param String $file
     * @return boolean
     */
    function removeFile(String $file)
    {
        try {
            if (file_exists($file)) {
                return unlink($file);
            } else {
                throw new Exception("File is not found");
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
