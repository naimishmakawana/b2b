<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignProducts extends Model
{
    protected $table = 'CampaignProducts';

    protected $primaryKey = 'CampaignProductId';
	
    protected $fillable = [
        'CampaignProductId','CampaignId','ProductId'
    ]; 
}
