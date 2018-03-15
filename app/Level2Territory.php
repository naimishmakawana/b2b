<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level2Territory extends Model
{
    protected $table = 'Level2Territory';
	
	protected $primaryKey = 'Level2TerritoryId';
	
    protected $fillable = [
        'Level2TerritoryId','Level2TerritoryName','ActiveStatus'
    ]; 
}
