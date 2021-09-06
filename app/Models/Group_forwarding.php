<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_forwarding extends Model
{
    use HasFactory;
    public static function showGroupsOne(int $id) {
        return self::select("country_id")->where("group_id",$id)->get();
    }
}
