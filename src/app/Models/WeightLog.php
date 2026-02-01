<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'weight',
        'calories',
        'exercise_time',
        'exercise_content',
    ];

    protected $casts = [
    'date' => 'date',
    ];

    public function getExerciseTimeFormattedAttribute()
{
    $time = (int) ($this->exercise_time ?? 0);
    $hours = intdiv($time, 60);
    $minutes = $time % 60;
    return sprintf('%02d:%02d', $hours, $minutes);
}


}
