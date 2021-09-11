<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected static function boot(){
        parent::boot();
        self::creating(function($table){
            if(! app()->runningInConsole()){
                $table->usersid_id=auth()->id();
                $table->teams_id=auth()->user()->currentTeam->id;
            }
        });
    }

    /**
     * Get the user that owns the Factura
     *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'clienteid_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'usersid_id');
    }

}
