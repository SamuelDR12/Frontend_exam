<?php

namespace App\Models;

use App\Models\Companies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone',
    ];

    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }
}
