<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
    ];

    public function attachable()
    {
        return $this->morphTo();
    }
}
