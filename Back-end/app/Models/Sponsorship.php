<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;
    protected $dates = ['expire_date'];
    public function teachers() {
        return $this->belongsToMany(Teacher::class)->withPivot('expire_date');
    }
}
