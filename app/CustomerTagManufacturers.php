<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerTagManufacturers extends Model
{
    protected $table = 'CustomerTagManufacturers';

    protected $primaryKey = 'CustomerTagManufacturerId';
	
    protected $fillable = [
        'CustomerTagManufacturerId','B2BCustomerId','TagManufacturerId'
    ]; 
}
