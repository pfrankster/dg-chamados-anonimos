<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interaction;
use App\Models\Chamado;

class InteractionController extends Controller
{
    public function store(Request $request)
    {
        $chamado = Chamado::where('login_hash', $request->login_hash)
            ->where('senha_numerica', $request->senha_numerica)
            ->first();

        if (!$chamado) {
            return response()->json(['message' => 'Chamado não encontrado.'], 404);
        }

        if ($chamado->status === 'Fechado') {
            return response()->json(['message' => 'Não é possível interagir com um chamado fechado.'], 403);
        }

        Interaction::create([
            'chamado_id' => $chamado->id,
            'tipo' => $request->tipo,
            'mensagem' => $request->mensagem,
        ]);

        return response()->json(['message' => 'Interação adicionada com sucesso.']);
    }

    public function show($id)
    {
        $interacoes = Interaction::find($id);

        return response()->json(compact('interacoes'));
    }
}
