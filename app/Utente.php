<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    public $timestamps = false;
    protected $table = "utenti";
    protected $primaryKey = "ID";
    protected $fillable = ['Nome','Password','permessi','lingua'];
    
    public function desideriObbiettivo() {
        return $this->belongsToMany("App\Obbiettivo", "App\Desiderio", "IDUtente","IDObbiettivo");
    }
    
    public function possessiObbiettivo() {
        return $this->belongsToMany("App\Obbiettivo", "App\Possesso", "IDUtente","IDObbiettivo");
    }
    
    public function desideriCorpo() {
        return $this->belongsToMany("App\Corpo", "App\Des", "IDUtente","IDCorpo");
    }
    
    public function possessiCorpo() {
        return $this->belongsToMany("App\Corpo", "App\Poss", "IDUtente","IDCorpo");
    }
}