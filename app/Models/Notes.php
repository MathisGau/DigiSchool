<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;

    public function evaluations()
    {
        return $this->belongsTo(Evaluation::class, 'evaluations_id', 'id');
    }  

    protected $fillable = [
        'user_id', 
        'evaluations_id',
        'evaluations_user_id',
        'mark',
        'description',
    ];
}
