<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignLevel2Territory extends Model
{
    protected $table = 'CampaignLevel2Territory';

    protected $primaryKey = 'CampaignLevel2TerritoryId';
	
    protected $fillable = [
        'CampaignLevel2TerritoryId','Level2TerritoryId','CampaignLevel1TerritoryId','TargetURL','QRCodeId','ActiveStatus'
    ]; 
}
