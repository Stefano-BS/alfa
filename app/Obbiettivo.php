<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Obbiettivo extends Model
{
    public $timestamps = false;
    protected $table = "obbiettivi";
    protected $primaryKey = "ID";
    protected $fillable = ['Nome Completo','LMin','LMax','F','FLMax','Rating','Marca','TAG','OSS'];
}