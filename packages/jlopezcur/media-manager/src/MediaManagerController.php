<?php

// namespace App\Http\Controllers;
namespace Jlopezcur\MediaManager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MediaManagerController extends Controller
{

    public function __construct()
    {
        $this->base = storage_path('app/uploads/');
        $this->allowed_extensions = [
            'png', 'jpg', 'ico', 'jpeg', 'tiff', 'tif', 'gif',
            'mp4', 'avi',
            'mp3',
            'pdf', 'xlsx', 'xls', 'doc', 'docx',
            'zip'
        ];
    }

    public function get($path = '')
    {
        $fullpath = $this->base . $path;
        if (file_exists($fullpath)) {
            $result = scandir($fullpath);

            $files = [];
            $dirs = [];

            foreach ($result as $file) {
                if (in_array($file, ['.', '..'])) continue;

                if (is_dir($fullpath . '/' . $file)) $dirs[] = $file;
                else {
                    if (!in_array(pathinfo($fullpath . '/' . $file, PATHINFO_EXTENSION), $this->allowed_extensions)) continue;
                    $files[] = $file;
                }
            }

            return response()->json(['dirs' => $dirs, 'files' => $files]);
        } else {
            return null;
        }
    }

    public function upload($path = '')
    {
        $fullpath = $this->base . $path . '/';
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $fullpath;
            $targetFile =  $targetPath. $_FILES['file']['name'];
            move_uploaded_file($tempFile,$targetFile);
        }
        return response()->json('ok');
    }

    public function newfolder($path = '')
    {
        mkdir($this->base . $path, 0777, true);
        return response()->json('ok');
    }

    public function delete(Request $request)
    {
        $files = $request->input('files');
        foreach($files as $file) {
            $fullpath = $this->base . $file;
            if (is_dir($fullpath)) {
                try {
                    rmdir($fullpath);
                } catch (\Exception $e) {
                    return response()->json(trans('error_directory_not_empty', ['directory' => $file]));
                }
            } else {
                unlink($fullpath);
            }
        }
        return response()->json('ok');
    }

}
