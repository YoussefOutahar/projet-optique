<?php
namespace App\Http\Controllers;

use App\Models\Reception;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionController extends Controller
{
    public function index()
    {
        $receptions = Reception::with('categorie')->paginate(4);
        return view('receptions.index', compact('receptions'));
    }
    public function create()
    {
    $fournisseurs = Fournisseur::all();
    $categories = Categorie::all();
    $user = Auth::user();

    return view('receptions.create', compact('fournisseurs', 'categories', 'user'));
    }
   public function store(Request $request)
{
    $request->validate([
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'date_reception' => 'required|date',
        'categorie_id' => 'required|exists:categories,id',
        'reference' => 'required|string|max:255',
        'quantite' => 'required|integer|min:1',
        'responsable' => 'required|string|max:255',
    ]);

    Reception::create([
        'fournisseur_id' => $request->fournisseur_id,
        'categorie_id' => $request->categorie_id, 
        'date_reception' => $request->date_reception,
        'reference' => $request->reference,
        'quantite' => $request->quantite,
        'responsable' => $request->responsable,
        'numero_reception' => 'REC-' . strtoupper(uniqid()),
    ]);

    return redirect()->route('receptions.index')->with('success', 'Réception créée avec succès.');
}


    public function show(Reception $reception)
    {
    $reception->load('categorie', 'fournisseur');
    
    return view('receptions.show', compact('reception'));
    }
    public function edit(Reception $reception)
    {
        $fournisseurs = Fournisseur::all();
        $categories = Categorie::all();  
        return view('receptions.edit', compact('reception', 'fournisseurs', 'categories'));
    }
    public function update(Request $request, Reception $reception)
    { 
        $request->validate([
            'date_reception' => 'required|date',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'categorie_id' => 'required|exists:categories,id',
            'quantite' => 'required|integer',
            'reference' => 'required|string|max:255',
            'responsable' => 'required|string|max:255', 
        ]);
        $reception->update($request->only([
            'date_reception',
            'fournisseur_id' ,
            'categorie_id' ,
            'quantite' ,
            'reference',
            'responsable'
        ]));        
        return redirect()->route('receptions.index')->with('success', 'Réception mise à jour avec succès.');
    }
    public function destroy(Reception $reception)
    {
        $reception->delete();
        return redirect()->route('receptions.index')->with('success', 'Réception supprimée avec succès.');
    }
}
