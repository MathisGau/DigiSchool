<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notes;
use App\Models\Subjects;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'type',
        'content',
        'is_reed',
    ];

}

