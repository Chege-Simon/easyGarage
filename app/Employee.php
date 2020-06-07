<?php

namespace App;
use App\Service;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
