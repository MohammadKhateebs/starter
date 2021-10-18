<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table='offers';//if the table name is not similar
    protected $fillable=['name','price'];
    protected $hidden=['created_at','updated_at'];
}
