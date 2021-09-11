<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected static function boot(){
        parent::boot();
        self::creating(function($table){
            if(! app()->runningInConsole()){
                $table->usersid_id=auth()->id();
            }
        });
    } 

    public function user()
    {
        return $this->belongsTo(User::class, 'usersid_id');
    }

    public function detfacturas()
    {
        return $this->hasMany(Detfactura::class,'productosid_id');
    }    
}
