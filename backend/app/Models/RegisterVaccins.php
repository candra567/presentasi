<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterVaccins extends Model
{
    use HasFactory;
    protected $table='table_vaccinations';
    protected $guarded='id_vaccinations';
    protected $primaryKey='id_vaccinations';
    public static function vaccins(){
        return self::join('table_users_vaksin','table_vaccinations.users_vaccinations','=','table_users_vaksin.id_users_vaksin')->join('table_hospital','table_vaccinations.locations_vaccins','=','table_hospital.id_hospital');
    }
}
