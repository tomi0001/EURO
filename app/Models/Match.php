<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;
    protected $table = "matchs";
    
    public static function selectListMatch() {
        
        return self::selectRaw("matchs.country_one  as country_one")->selectRaw("matchs.id  as id")
                ->selectRaw("matchs.country_two  as country_two")
                ->selectRaw("matchs.result_one  as result_one")->selectRaw("matchs.result_two  as result_two")
                ->selectRaw("matchs.created_at as created_at")->selectRaw("matchs.updated_at as updated_at")
                ->selectRaw("matchs.date  as date")->paginate(10);
    }
    public static function selectListMatchWhere(string $name) {
        return self::join("countries",function ($join) {
            $join->on('countries.id',"matchs.country_one")->orOn("countries.id","matchs.country_two");
            
        })      ->selectRaw("matchs.country_one  as country_one")->selectRaw("matchs.id  as id")
                ->selectRaw("matchs.country_two  as country_two")
                ->selectRaw("matchs.result_one  as result_one")->selectRaw("matchs.result_two  as result_two")
                ->selectRaw("matchs.created_at as created_at")->selectRaw("matchs.updated_at as updated_at")
                ->selectRaw("matchs.date  as date")->where("countries.name","like","%$name%")->paginate(10);        
    }
}
