<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected static function boot(){
        parent::boot();
        self::creating(function($table){
            if(! app()->runningInConsole()){
                $table->idusersid_id=auth()->id();
                $table->teams_id=auth()->user()->currentTeam->id;
            }
        });
    }   
    
    /**
     * Get the user that owns the Factura
     *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tiposid(){
        return $this->belongsTo(Tiposid::class, 'tiposid_id');
    }    
    public function user()
    {
        return $this->belongsTo(User::class, 'idusersid_id');
    }
    /**
     * Get the facturas for the cliente.
     */
    public function factura()
    {
        return $this->hasOne(Factura::class,'clienteid_id');
    }
    public function facturas()
    {
        return $this->hasMany(Factura::class,'clienteid_id');
    }

    public function historia()
    {
        return $this->hasOne(Historia::class,'clienteid_id');
    }
    public function historias()
    {
        return $this->hasMany(Historia::class,'clienteid_id');
    }

    public function detfactura()
    {
        return $this->hasOne(Detfactura::class,'clientesid_id');
    }
    public function detfacturas()
    {
        return $this->hasMany(Detfactura::class,'clientesid_id');
    }

}
