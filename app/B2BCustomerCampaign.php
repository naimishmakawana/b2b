<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class B2BCustomerCampaign extends Model
{
    protected $table = 'B2BCustomerCampaign';
	
	protected $primaryKey = 'CampaignId';

    protected $fillable = [
        'CampaignId','B2BCustomerId','CampaignName','CampaignObjective','CampaignStartDate','CampaignEndDate','QRCodeId','RedirectURL','EndDateRedirectURL','Repeat','ActiveStatus'
    ]; 
}
