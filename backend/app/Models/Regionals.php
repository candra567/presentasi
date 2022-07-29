<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regionals extends Model
{
    use HasFactory;
    protected $table='table_regionals';
    protected $guarded=['id_regionals'];
}
