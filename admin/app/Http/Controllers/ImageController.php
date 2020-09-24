<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    
    public function store($data, $folder)
    {
        
        $nameFile = null;
    
        $name = uniqid(date('HisYmd'));
        
        if(!is_file($data['image'])) {
            $nameFile = $data['image'];
            return $nameFile;
        }

        if($data['image']) {
            $file = $data['image'];
            $extension = $data['image']->extension();
            $nameFile = "/images".$folder.'/'.$name.'.'.$extension;
            $basepath = dirname(base_path(), 1);
            
            $file->move($basepath.'/images'.$folder, $nameFile);
    
            return $nameFile;
            
            if ( !$nameFile )
                return redirect()
                            ->back()
                            ->with('error', 'Upload failed')
                            ->withInput();
        }
    
    }

}