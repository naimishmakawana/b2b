<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignSequentialTaps extends Model
{
    protected $table = 'CampaignSequentialTaps';
	
	protected $primaryKey = 'CampaignSequentialTapId';

    protected $fillable = [
        'CampaignSequentialTapId','CampaignId','RedirectURL'
    ]; 
}
