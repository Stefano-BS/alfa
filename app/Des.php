<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Des extends Model
{
    public $timestamps = false;
    protected $table = "des";
    protected $fillable = ["IDUtente","IDCorpo"];
}