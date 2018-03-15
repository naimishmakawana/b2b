<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NFCTag extends Model
{
    protected $table = 'NFCTag';
	
	protected $primaryKey = 'NFCTagId';

    protected $fillable = [
        'NFCTagId','TagId','CampaignLevel1TerritoryId','CampaignLevel2TerritoryId','CampaignId','TagURL','RedirectURL','NFCTagBundleId','TagManufacturerId','CampaignProductId','ActiveStatus','CreatedAt','ModifyAt'
    ]; 
}
