<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'telephone_one',
        'telephone_two',
        'telephone_three',
        'address',
        'building_name',
        'inquiry_type',
        'content',
    ];
}
