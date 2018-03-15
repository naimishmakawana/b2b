<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level1Territory extends Model
{
    protected $table = 'Level1Territory';
	
	protected $primaryKey = 'Level1TerritoryId';
	
    protected $fillable = [
        'Level1TerritoryId','B2BCustomerId','Level1TerritoryName','ActiveStatus'
    ]; 
}
