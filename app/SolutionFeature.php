<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolutionFeature extends Model
{
    protected $table = 'SolutionFeature';
	
	protected $primaryKey = 'SolutionFeatureId';
	
    protected $fillable = [
        'SolutionFeatureId','B2BCustomerId','SolutionFeatureName','ActiveStatus'
    ]; 
}
