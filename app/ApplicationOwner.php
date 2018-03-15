<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationOwner extends Model
{
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ApplicationOwner';
    
    protected $fillable = [
        'OwnerId','NameOfOrganization','AddressFirstLine','AddressSecondLine','City','State','PostalCode','CountryId','ContactPersonFirstName','ContactPersonLastName','ContactPersonEmailAddress','ContactPersonDesignation','ContactPersonTelNumber'
    ]; 
}
