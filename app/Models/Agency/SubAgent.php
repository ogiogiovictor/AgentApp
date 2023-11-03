<?php

namespace App\Models\Agency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAgent extends Model
{
    use HasFactory;

    protected $table = 'sub_agent';

    protected $fillable = [
        'name',
        'email',
        'agency_id',
        'address',
        'phone',
        'date_of_engagement',
        
    ];
}
