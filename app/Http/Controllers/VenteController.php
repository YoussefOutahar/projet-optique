<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index()
    {
        $ventes = Vente::paginate(4);
        return view('ventes.index', compact('ventes'));
    }

    public function create()
    {
        $clients = Client::all();
        $factures = Facture::all();
        $user = auth()->user(); 

        return view('ventes.create', compact('clients', 'factures', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_vente' => 'required|string|max:255',
            'date_facture' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|string|max:20',
            'total' => 'required|numeric|min:0',
            'remise' => 'nullable|numeric|min:0',
            'avance' => 'nullable|numeric|min:0',
            'reste_a_payer' => 'nullable|numeric|min:0',
            'responsable' => 'required|string|max:255',
        ]);

        Vente::create([
            'numero_vente' => $request->numero_vente,
            'date_facture' => $request->date_facture,
            'client_id' => $request->client_id,
            'status' => $request->status,
            'total' => $request->total,
            'remise' => $request->remise ?? 0, 
            'avance' => $request->avance ?? 0, 
            'reste_a_payer' => $request->reste_a_payer ?? 0, 
            'responsable' => $request->responsable,
        ]);

        return redirect()->route('ventes.index')->with('success', 'Vente créée avec succès.');
    }

    public function categorieReference($venteId)
    {
        $vente = Vente::findOrFail($venteId);
        $produits = Produit::all();
        $categories = Categorie::all(); 
        $references = Produit::pluck('reference', 'id'); 

        return view('ventes.categorie_reference', compact('vente', 'produits', 'categories', 'references'));
    }

    public function updateCategorieReference(Request $request, $venteId)
    {
        if (!is_array($request->produit_id)) {
            return redirect()->back()->withErrors('Les produits ne sont pas valides.');
        }
        $vente = Vente::findOrFail($venteId);
        $vente->produits()->detach();

        foreach ($request->produit_id as $key => $produitId) {
            $vente->produits()->attach($produitId, [
                'quantite' => $request->quantite[$key],
                'categorie_id' => $request->categorie_id[$key], 
            ]);
        }

        return redirect()->route('ventes.index')->with('success', 'Les produits ont été mis à jour avec succès.');
    }

    public function editCategorieReference($venteId)
    {
        $vente = Vente::findOrFail($venteId);
        $categories = Categorie::all(); 
        $produits = Produit::all(); 

        return view('ventes.categorie_reference', compact('vente', 'categories', 'produits'));
    }

    public function getVenteByClient($clientId)
    {
        $vente = Vente::where('client_id', $clientId)->latest()->first();

        return response()->json(['vente' => $vente]);
    }

    public function show(Vente $vente)
    {
        $vente->load('produits.categorie');
        return view('ventes.show', compact('vente'));
    }

    public function edit(Vente $vente)
    {
        $clients = Client::all();
        $factures = Facture::all();
        return view('ventes.edit', compact('vente', 'clients', 'factures'));
    }

    public function update(Request $request, Vente $vente)
    {
        $request->validate([
            'numero_vente' => 'required|string|max:255',
            'date_facture' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|string|max:20',
            'total' => 'required|numeric',
            'remise' => 'nullable|numeric',
            'avance' => 'nullable|numeric',
            'reste_a_payer' => 'nullable|numeric',
        ]);

        $vente->update($request->all());
        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès.');
    }

    public function saveAndContinue(Request $request)
    {
        $request->validate([
            'numero_vente' => 'required|string',
            'client_id' => 'required|integer',
            'total' => 'required|numeric',
            'remise' => 'required|numeric',
            'avance' => 'required|numeric',
            'reste_a_payer' => 'required|numeric',
        ]);

        $vente = Vente::create($request->all());

        return redirect()->route('ventes.categorie_reference', ['venteId' => $vente->id]);
    }

    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }

    public function showCategorieReference($venteId)
    {
        $vente = Vente::findOrFail($venteId);  
        $produits = Produit::all();      
        $categories = Categorie::all(); 
        return view('ventes.categorie_reference', compact('vente', 'produits', 'categories'));
    }
}
