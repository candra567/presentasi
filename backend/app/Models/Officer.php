<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;
    protected $table='table_officer';
    protected $guarded=['id_officer'];
    public static function officer(){
        return self::join('table_regionals','table_officer.regionals_officer','=','table_regionals.id_regionals');
    }
}
