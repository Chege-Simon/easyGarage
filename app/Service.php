<?php

namespace App;
use App\Employee;
use App\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
