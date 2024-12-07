<?php
namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::whereNull('deleted_at')->paginate(5);

        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'societe' => 'required|string|max:255|unique:fournisseurs,societe',
            'responsable' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'telephone' => ['required', 'string', 'max:20', 'regex:/^(\+212|0)[5-7]\d{8}$/'],
            'mobile' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'ice' => 'required|string|digits:15|unique:fournisseurs,ice',
            'observation' => 'nullable|string',
        ], [
            'societe.unique' => 'Le nom de la société est déjà utilisé.',
            'ice.unique' => 'L\'ICE que vous avez entré est déjà associé à une autre société. Veuillez saisir un autre ICE.',
        ]);

        Fournisseur::create($request->all());
        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur créé avec succès.');
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function show(Fournisseur $fournisseur)
    {
        
        return view('fournisseurs.show', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'societe' => 'required|string|max:255|unique:fournisseurs,societe,' . $fournisseur->id,
            'responsable' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'telephone' => ['required', 'string', 'max:20', 'regex:/^(\+212|0)[5-7]\d{8}$/'],
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'ice' => 'required|string|digits:15|unique:fournisseurs,ice,' . $fournisseur->id,
            'observation' => 'nullable|string',
        ], [
            'societe.unique' => 'Le nom de la société est déjà utilisé.',
            'ice.unique' => 'L\'ICE que vous avez entré est déjà associé à une autre société. Veuillez saisir un autre ICE.',
        ]);

        $fournisseur->update($request->all());

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur mis à jour avec succès.');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès.');
    }
}


