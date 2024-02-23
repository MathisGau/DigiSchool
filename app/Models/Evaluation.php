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
        'subject_id',
        'title',
        'coeff',
    ];
    public function subjectModel()
    {
        return $this->belongsTo(Subjects::class, 'subject_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Notes::class, 'evaluations_id', 'id');
    }
}

