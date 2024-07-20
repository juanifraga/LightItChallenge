<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['name', 'email', 'phone_number', 'document_photo_path'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'email_verified' => 'boolean',
    ];
}
