<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    protected $table = 'QRCode';
	
	protected $primaryKey = 'QRCodeId';

    protected $fillable = [
        'QRCodeId','B2BCustomerId','QRCodeFileName','QRCodeImageURL','QRCodeGeneratorName','RedirectURL','ActiveStatus','CreatedAt','ModifyAt'
    ]; 
}
