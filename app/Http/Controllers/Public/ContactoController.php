<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        return view('public.contactos');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'telefone' => 'nullable|string|max:30',
            'assunto' => 'required|string|max:150',
            'mensagem' => 'required|string|max:2000',
        ]);

        return redirect()
            ->route('contactos.index')
            ->with('success', 'O seu pedido de contacto foi enviado com sucesso. Responderemos brevemente.');
    }
}
