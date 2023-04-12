<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'father_name',
        'date_of_birth',
        'temporary_address',
        'permanent_address',
        'city',
        'tajneed_number',
        'ammart_id',
        'halqa_id',
        'phone_number',
        'email',
        'current_class',
        'group',
        'subject',
        'name_of_institution',
        'current_education_status',
        'year_of_education_completed',
        'added_by',
        'edited_by',
        'deleted',
    ];
}
