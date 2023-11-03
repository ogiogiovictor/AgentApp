<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECMICustomers extends Model
{
    use HasFactory;

    protected $table = "ECMI.dbo.Customers";

    protected $connection = 'ecmi_prod';

    public $timestamps = false;

}
