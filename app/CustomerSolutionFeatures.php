<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerSolutionFeatures extends Model
{
    protected $table = 'CustomerSolutionFeatures';

    protected $primaryKey = 'CustomerSolutionFeatureId';
	
    protected $fillable = [
        'CustomerSolutionFeatureId','B2BCustomerId','SolutionFeatureId'
    ]; 
}
