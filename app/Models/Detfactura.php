<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detfactura extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function productos()
    {
        return $this->belongsTo(Producto::class,'productosid_id');
    }    
}
