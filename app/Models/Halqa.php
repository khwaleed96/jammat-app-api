<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ammart;
use App\Models\User;

class Halqa extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ammart_id',
        'city',
    ];

    public function ammart()
    {
        return $this->belongsTo(Ammart::class);
    }

    public function Users()
    {
        return $this->hasMany(User::class);
    }
}
