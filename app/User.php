<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password', 'lingua'];

    //The attributes that should be hidden for arrays.
    protected $hidden = ['password', 'remember_token'];

    //The attributes that should be cast to native types.
    protected $casts = ['email_verified_at' => 'datetime'];
    
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
