<?php

namespace App\Models\AppWide;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class appAuthorization extends Model
{
    use HasFactory;

    protected  $table = "app_authorization";

    protected $fillable = [
        'domain_name',
        'ip_address',
        'app-secret',
        'app-token',
        'App_Name',
        'status',
    ];

}
