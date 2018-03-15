<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignLevel1Territory extends Model
{
    protected $table = 'CampaignLevel1Territory';

    protected $primaryKey = 'CampaignLevel1TerritoryId';
	
    protected $fillable = [
        'CampaignLevel1TerritoryId','CampaignId','Level1TerritoryId','TargetURL','QRCodeId','ActiveStatus'
    ]; 
}
