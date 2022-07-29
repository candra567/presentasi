<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotsVaccins extends Model
{
    use HasFactory;
    protected $table='table_spots_vaccins';
    protected $guarded=['id_spots_vaccins'];
    public static function spots(){
        return self::join('table_hospital','table_spots_vaccins.locations_spots_vaccins','=','table_hospital.id_hospital')->join('table_vaccins','table_spots_vaccins.lists_vaccins','=','table_vaccins.id_vaccins')->join('table_regionals','table_hospital.location_hospital','=','table_regionals.id_regionals')
        ->join('table_doctor','table_hospital.doctor_hospital','=','table_doctor.id_doctor');
    }
}
