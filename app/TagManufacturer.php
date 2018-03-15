<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagManufacturer extends Model
{
    protected $table = 'TagManufacturer';
	
	protected $primaryKey = 'TagManufacturerId';

    protected $fillable = [
        'TagManufacturerId','OwnerId','ManufacturerName','AddressFirstLine','AddressSecondLine','City','State','PostalCode','CountryId','ContactPersonFirstName','ContactPersonLastName','ContactPersonEmailAddress','ContactPersonDesignation','ContactPersonTelNumber','ActiveStatus'
    ]; 
}
