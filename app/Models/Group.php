<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public static function selectGroup(string $name) {
        return self::select("name")->where("name",$name)->first();
    }
    public static function selectNameGroupId(int $id) {
        return self::select("name")->where("id",$id)->first();
    }
    public static function showGroups() {
        return self::selectRaw("name as name")->selectRaw("id as id")->orderBy("name")->get();
    }
    public static function selectCountry(string $name) {
        return self::join("group_forwardings","group_forwardings.group_id","groups.id")->join("countries","group_forwardings.country_id","countries.id")
                ->selectRaw("countries.name as name")->selectRaw("group_forwardings.id as id")->where("groups.name",$name)->get();
    }
    public static function returnIdGroup( $name = "") {
        if ($name == "") {
            return self::select("id")->orderBy("id")->first();
        }
        else {
            return self::select("id")->where("name",$name)->orderBy("id")->first();
        }
    }
}
