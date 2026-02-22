<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;
    protected $fillable = ['chamado_id', 'tipo', 'mensagem', 'user_id'];

    public function anexos()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
