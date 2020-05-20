<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Poss extends Model
{
    public $timestamps = false;
    protected $table = "poss";
    protected $fillable = ["IDUtente","IDCorpo"];
}