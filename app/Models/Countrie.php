<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{
    use HasFactory;
    public static function selectCountry(string $name) {
        return self::select("name")->where("name",$name)->first();
    }
    public static function selectListCountry() {
        return self::selectRaw("name as name")->selectRaw("id as id")->get();
    }
    public static function selectNameIdMatch(int $id) {
        return self::select("name")->where("id",$id)->first();
    }
}
