<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use Illuminate\Support\Str;

class ChamadoController extends Controller
{
    // Exibir o formulário de criação de chamado
    public function create()
    {
        return view('chamados.gerar');
    }

    // Processar o formulário e salvar um chamado
    public function store(Request $request)
    {
        $request->validate([
            'assunto' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|string|max:255',
        ]);

        // Gerar login hash de 8 caracteres e senha numérica de 8 dígitos
        $login = Str::random(8);
        $senha = rand(10000000, 99999999);

        $chamado = Chamado::create([
            'assunto' => $request->assunto,
            'tipo' => $request->tipo,
            'descricao' => $request->descricao,
            'login_hash' => $login,
            'senha_numerica' => $senha,
            'status' => 'Aberto',
        ]);

        return view('chamados.sucesso', compact('login', 'senha'));
    }

    // Exibir o formulário de consulta de chamado
    public function showConsulta()
    {
        return view('chamados.consulta');
    }

    // Buscar chamado pelo login e senha
    public function buscar(Request $request)
    {
        $request->validate([
            'login' => 'required|string|size:8',
            'senha' => 'required|digits:8',
        ]);

        $chamado = Chamado::where('login_hash', $request->login)
            ->where('senha_numerica', $request->senha)
            ->first();

        if (!$chamado) {
            return back()->withErrors(['message' => 'Chamado não encontrado.']);
        }

        return redirect()->route('chamado.detalhes', ['hash' => $chamado->login_hash]);
    }

    // Exibir detalhes do chamado e interações
    public function detalhes($hash)
    {
        $chamado = Chamado::where('login_hash', $hash)->firstOrFail();
        return view('chamados.detalhes', compact('chamado'));
    }

    // Adicionar uma interação ao chamado
    public function interagir(Request $request, $hash)
    {
        $request->validate([
            'mensagem' => 'required|string',
        ]);

        $chamado = Chamado::where('login_hash', $hash)->firstOrFail();

        if ($chamado->status === 'fechado') {
            return back()->withErrors(['message' => 'Chamado fechado, não é possível adicionar interações.']);
        }

        $chamado->interacoes()->create([
            'mensagem' => $request->mensagem,
            'tipo' => 'solicitante',
        ]);

        return back()->with('success', 'Interação adicionada com sucesso.');
    }


    // Exibir todos os chamados para o administrador
    public function listar()
    {
        $chamados = Chamado::orderBy('created_at', 'desc')->get();
        return view('admin.chamados', compact('chamados'));
    }

    // Exibir detalhes do chamado e interações para o administrador
    public function detalhesAdmin($hash)
    {
        $chamado = Chamado::where('login_hash', $hash)->firstOrFail();
        return view('admin.detalhes', compact('chamado'));
    }

    // Adicionar uma resposta como administrador
    public function respostaAdmin(Request $request, $hash)
    {
        $request->validate([
            'mensagem' => 'required|string',
            'status' => 'required|string|in:Aberto,Fechado',
        ]);

        $chamado = Chamado::where('login_hash', $hash)->firstOrFail();

        // Verificar se o chamado já está fechado
        if ($chamado->status === 'fechado') {
            return back()->withErrors(['message' => 'Chamado já está fechado.']);
        }

        // Adicionar a resposta do administrador
        $chamado->interacoes()->create([
            'mensagem' => $request->mensagem,
            'tipo' => 'admin',
        ]);

        // Alterar o status do chamado, se necessário
        $chamado->status = $request->status;
        $chamado->save();

        return back()->with('success', 'Resposta adicionada com sucesso.');
    }
}
