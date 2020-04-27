<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public $table = 'cars'; 
    protected $fillable = ['licenseplate','make','model','address','image'];
}
