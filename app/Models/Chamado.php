<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interaction;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = ['assunto', 'tipo', 'descricao', 'login_hash', 'senha_numerica', 'status'];

    public function interacoes()
    {
        return $this->hasMany(Interaction::class, 'chamado_id');
    }

    public function ultimaInteracao()
    {
        return $this->hasOne(Interaction::class, 'chamado_id')->latestOfMany();
    }

    public function anexos()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function precisaAtencao()
    {
        if ($this->status === 'Fechado' || $this->status === 'Concluído') {
            return false;
        }

        // Se não houver interações, é um chamado novo que precisa de atenção
        if (!$this->ultimaInteracao) {
            return true;
        }

        // Se a última interação foi do solicitante, precisa de atenção
        return $this->ultimaInteracao->tipo === 'solicitante';
    }
}
