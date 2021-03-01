<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait FileMethods
{
    public function manageFile64($model, $file, $field, $disk, $folder)
    {
        $currentName = $model->{$field};
       
        $filename = uniqid() . "-" . $field;
        $model->{$field} = $this->addFile64($disk, $folder, $file, $filename, $currentName);
        $model->update();
    }

    public function addFile64($disk, $name_folder, $file, $name, $last_name = null)
    {
        $extension = $this->getBase64Ext($file);
        $filename = $name_folder.'/'. Str::slug($this->clearString($name), "-") . $extension;
        
        Storage::disk($disk)->put($filename, $file);

        return $filename;
    }

    public function getBase64Ext($file)
    {
        $f = finfo_open();
        $result = finfo_buffer($f, $file, FILEINFO_MIME_TYPE);
        $result = explode('/', $result);
        $ext = ".".$result[1];

        return $ext;
    }

    public function clearString($string)
    {
        $string = trim($string);
 
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );
     
        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );
     
        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );
     
        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );
     
        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );
     
        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        $string = str_replace(
            array('+', '-', '(', ')'),
            array('-', '-', '-', '-',),
            $string
        );

        $string = str_replace(
            array('/'),
            array('-'),
            $string
        );
     
        return $string;
    }
}
