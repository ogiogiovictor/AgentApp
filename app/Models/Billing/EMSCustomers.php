<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EMSCustomers extends Model
{
    use HasFactory;

    protected $table = "EMS_ZONE.dbo.CustomerNew";

    protected $connection = 'zone_connection';

    public $timestamps = false;
}
