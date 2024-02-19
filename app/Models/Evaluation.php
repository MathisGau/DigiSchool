<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notes;
use App\Models\Subjects;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'title',
        'coeff',
    ];
    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subject', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Notes::class, 'evaluations_id', 'id');
    }
}

