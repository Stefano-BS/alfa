<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Possesso extends Model
{
    public $timestamps = false;
    protected $table = "possedimenti";
    protected $fillable = ["IDUtente","IDObbiettivo"];
}