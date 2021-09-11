<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cie10tmp extends Model
{
    use HasFactory;

    protected $table = 'cie10tmp';
    public $timestamps = false;
    protected $fillable = ['codigo','nombre','sexo','edadminima','edadmaxima'];  
       
}
