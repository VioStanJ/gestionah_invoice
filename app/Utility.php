<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\File;

class Utility extends Model
{
    public static function languages()
    {
        $dir     = base_path() . '/resources/lang/';
        $glob    = glob($dir . "*", GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir){
                return str_replace($dir, '', $value);
            }, $glob
        );
        $arrLang = array_map(
            function ($value) use ($dir){
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }

    public static function getCompany(User $user)
    {
        if(!isset($user->userCompany)){
            return redirect()->back()->withErrors(['Company not found !']);
        }
        return $user->userCompany->company;
    }

    public static function mkdir($name)
    {
        // '/channels/cover'
        if(!File::isDirectory($name)){
            File::makeDirectory($name, 0777, true, true);
        }
    }
}
