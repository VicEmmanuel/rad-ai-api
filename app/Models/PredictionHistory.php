<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',                // Store the image path or base64 string
        'prediction_class',
        'confidence'
    ];

    // Relationships (if needed)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
