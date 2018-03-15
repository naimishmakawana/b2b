<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class B2BCustomerProduct extends Model
{
    protected $table = 'B2BCustomerProduct';
	
	protected $primaryKey = 'ProductId';
	
    protected $fillable = [
        'ProductId','B2BCustomerId','ProductName','ProductImage','ActiveStatus'
    ]; 
}
