<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
class GlobalFunction
{
    public $defaultlimitpage = 10;
    
    public static function instance()
    {
        return new GlobalFunction();
    }

    public static function config($nama_config){
        $config = DB::table('sm_m_config')->where('nama_config',$nama_config)->first();
        if($config){
            return $config->value;
        }
        return null;
    }
}
