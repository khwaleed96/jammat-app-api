<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Halqa;
use App\Models\User;

class Ammart extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'name',
        'city',
    ];

    public function halqas()
    {
        return $this->hasMany(Halqa::class);
    }

    public function Users()
    {
        return $this->hasMany(User::class);
    }
}
