<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level1TerritoryLevel2Territories extends Model
{
    protected $table = 'Level1TerritoryLevel2Territories';

    protected $primaryKey = 'Level1TerritoryLevel2TerritoryId';
	
    protected $fillable = [
        'Level1TerritoryLevel2TerritoryId','Level1TerritoryId','Level2TerritoryId'
    ]; 
}
