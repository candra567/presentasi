<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersVaksin extends Model
{
    use HasFactory;
    protected $table='table_users_vaksin';
    protected $guarded=['id_users_vaksin'];
    protected $primaryKey='id_users_vaksin';
    public static function user(){
        return self::join('table_regionals','table_users_vaksin.regionals_users_vaksin','=','table_regionals.id_regionals');
    }
}
