<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultations extends Model
{
    use HasFactory;
    protected $table='table_consultations';
    protected $guarded=['id_consultations'];
    protected $primaryKey='id_consultations';
    public static function consultations(){
       return self::join('table_users_vaksin','table_consultations.users_consultations','=','table_users_vaksin.id_users_vaksin');
    }
    public static function allData(){
        return self::select('name_users_vaksin','name_officer','disease_history','current_symptoms','number_consultations','status_consultations')->join('table_users_vaksin','table_consultations.users_consultations','=','table_users_vaksin.id_users_vaksin')->join('table_officer','table_consultations.officer_consultations','=','table_officer.id_officer');
    }
}
