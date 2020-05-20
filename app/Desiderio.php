<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Desiderio extends Model
{
    public $timestamps = false;
    protected $table = "desideri";
    protected $fillable = ["IDUtente","IDObbiettivo"];
}