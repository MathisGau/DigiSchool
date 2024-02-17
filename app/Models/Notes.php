<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }
    

    protected $fillable = [
        'user_id', 
        'evaluations_id',
        'evaluations_user_id',
        'mark',
        'description',
    ];
}
