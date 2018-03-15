<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class B2BCustomer extends Model
{
    protected $table = 'B2BCustomer';

    protected $primaryKey = 'CustomerId';
	
    protected $fillable = [
        'CustomerId','ApplicationOwnerOwnerId','NameOfOrganization','AddressFirstLine','AddressSecondLine','City','State','PostalCode','CountryId','ContactPersonFirstName','ContactPersonLastName','ContactPersonEmailAddress','ContactPersonDesignation','ActiveStatus'
    ]; 
}
