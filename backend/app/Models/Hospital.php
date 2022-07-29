<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table='table_hospital';
    protected $guarded=['id_hospital'];
    public static function hospital(){
        return self::join('table_regionals','table_hospital.location_hospital','=','table_regionals.id_regionals');
    }
}
