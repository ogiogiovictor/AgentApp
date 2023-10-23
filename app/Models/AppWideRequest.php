<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppWideRequest extends Model
{
    use HasFactory;

    protected $table = 'app_request';

    protected $casts = [
        'payload' => 'collection',
    ];

    protected $fillable = [
        'user_id',
        'ip_address',
        'ajax',
        'url',
        'method',
        'user_agent',
        'payload',
        'status_code',
        'response',
    ];
}
