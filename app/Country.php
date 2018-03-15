<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'Country';
    
    protected $fillable = [
        'id','CountryName','CountryCode'
    ]; 
}
