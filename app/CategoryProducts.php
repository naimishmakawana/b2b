<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProducts extends Model
{
    protected $table = 'CategoryProducts';

    protected $primaryKey = 'CategoryProductId';
	
    protected $fillable = [
        'CategoryProductId','CategoryId','ProductId'
    ]; 
}
