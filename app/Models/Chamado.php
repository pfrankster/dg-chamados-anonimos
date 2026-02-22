<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interaction;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = ['assunto', 'instituicao', 'descricao', 'login_hash', 'senha_numerica', 'status'];

    public function interacoes()
    {
        return $this->hasMany(Interaction::class, 'chamado_id');
    }
}
