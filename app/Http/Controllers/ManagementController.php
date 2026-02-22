<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagementController extends Controller
{
    public function adminDashboard()
    {
        return view('mgmt.admin.dashboard');
    }

    public function attendantDashboard()
    {
        return view('mgmt.attendant.dashboard');
    }

    public function listAttendants()
    {
        $attendants = User::where('role', 'attendant')->get();
        return view('mgmt.admin.atendentes', compact('attendants'));
    }

    public function storeAttendant(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'attendant',
        ]);

        return redirect()->route('mgmt.admin.atendentes')->with('success', 'Atendente criado com sucesso!');
    }

    public function destroyAttendant($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'attendant') {
            return redirect()->back()->withErrors(['message' => 'Apenas atendentes podem ser excluídos.']);
        }

        $user->delete();

        return redirect()->route('mgmt.admin.atendentes')->with('success', 'Atendente excluído com sucesso!');
    }
}
