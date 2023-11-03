<?php

namespace App\Models\Agency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $table = 'agency';

    protected $fillable = [
        'name',
        'ceo_name',
        'ceo_phone',
        'ceo_email',
        'no_sub_agents',
        'date_of_engagement',
        'agency_code',
    ];
}
