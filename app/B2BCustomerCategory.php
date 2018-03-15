<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class B2BCustomerCategory extends Model
{
    protected $table = 'B2BCustomerCategory';
	
	protected $primaryKey = 'CategoryId';

    protected $fillable = [
        'CategoryId','B2BCustomerId','CategoryName','ActiveStatus'
    ]; 
}
