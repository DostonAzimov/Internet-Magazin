<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingInfo extends Model
{
    use HasFactory;

    protected $table="setting_infos";

    protected $fillable=['email','phoneNumber','phoneNumber2','address'
        ,'map','facebook','instagram','youtube','telegram'];
}
