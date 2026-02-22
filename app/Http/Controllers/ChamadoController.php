<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use Illuminate\Support\Str;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

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
            'anexos' => 'nullable|array|max:5',
            'anexos.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
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

        if ($request->hasFile('anexos')) {
            $this->uploadAnexos($request->file('anexos'), $chamado);
        }

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
        $chamado = Chamado::where('login_hash', $hash)
            ->with(['anexos', 'interacoes.anexos'])
            ->firstOrFail();
        return view('chamados.detalhes', compact('chamado'));
    }

    // Adicionar uma interação ao chamado
    public function interagir(Request $request, $hash)
    {
        $request->validate([
            'mensagem' => 'required|string',
            'anexos' => 'nullable|array|max:5',
            'anexos.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $chamado = Chamado::where('login_hash', $hash)->firstOrFail();

        if ($chamado->status === 'fechado') {
            return back()->withErrors(['message' => 'Chamado fechado, não é possível adicionar interações.']);
        }

        $interacao = $chamado->interacoes()->create([
            'mensagem' => $request->mensagem,
            'tipo' => 'solicitante',
        ]);

        if ($request->hasFile('anexos')) {
            $this->uploadAnexos($request->file('anexos'), $interacao);
        }

        return back()->with('success', 'Interação adicionada com sucesso.');
    }


    /*
    |--------------------------------------------------------------------------
    | Métodos da Nova Área de Gestão
    |--------------------------------------------------------------------------
    */

    public function listarMgmt(Request $request)
    {
        $query = Chamado::with('ultimaInteracao');

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por tipo
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Pesquisa por assunto ou protocolo
        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca) {
                $q->where('assunto', 'like', "%{$busca}%")
                    ->orWhere('login_hash', 'like', "%{$busca}%")
                    ->orWhere('descricao', 'like', "%{$busca}%");
            });
        }

        // Filtro "Aguardando Resposta"
        if ($request->filled('atencao') && $request->atencao == '1') {
            $query->where(function ($q) {
                $q->whereDoesntHave('interacoes')
                    ->orWhereHas('ultimaInteracao', function ($sub) {
                        $sub->where('tipo', 'solicitante');
                    });
            })->whereNotIn('status', ['Fechado', 'Concluído']);
        }

        $chamados = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('mgmt.chamados.index', compact('chamados'));
    }

    public function detalhesMgmt($hash)
    {
        $chamado = Chamado::where('login_hash', $hash)
            ->with(['anexos', 'interacoes.anexos'])
            ->firstOrFail();
        return view('mgmt.chamados.detalhes', compact('chamado'));
    }

    public function respostaMgmt(Request $request, $hash)
    {
        $request->validate([
            'mensagem' => 'required|string',
            'status' => 'required|string|in:Aberto,Em Análise,Fechado,Concluído',
            'anexos' => 'nullable|array|max:5',
            'anexos.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $chamado = Chamado::where('login_hash', $hash)->firstOrFail();

        // Adicionar interação do atendente/admin
        $interacao = $chamado->interacoes()->create([
            'mensagem' => $request->mensagem,
            'tipo' => 'resposta',
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('anexos')) {
            $this->uploadAnexos($request->file('anexos'), $interacao);
        }

        $chamado->update(['status' => $request->status]);

        return back()->with('success', 'Resposta enviada com sucesso!');
    }

    private function uploadAnexos($files, $model)
    {
        foreach ($files as $file) {
            $path = $file->store('anexos', 'public');

            $model->anexos()->create([
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }
    }
}
