<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpo extends Model
{
    public $timestamps = false;
    protected $table = "corpi";
    protected $primaryKey = "ID";
    protected $fillable = ['Nome','Data','MSRP','Materiale','Risoluzione','Formato','MaxISO','MaxISOExt','OSS','AF','Schermo','Mirino','Touch','MaxSS','Flash','FPS','QHD','FHD','CIPA','Peso'];
}
