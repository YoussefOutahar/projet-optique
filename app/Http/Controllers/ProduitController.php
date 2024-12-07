<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->paginate(10);
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
        return view('produits.create', compact('categories', 'fournisseurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',  
            'fournisseur_id' => 'required|exists:fournisseurs,id', 
            'quantite_stock' => 'required|integer|min:0',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0|gt:prix_achat',  
        ], [
            'categorie_id.required' => 'La catégorie est obligatoire.',
            'prix_vente.gt' => 'Le prix de vente doit être supérieur au prix d\'achat.',
        ]);

        Produit::create([
            'reference' => $request->reference,
            'marque' => $request->marque,
            'categorie_id' => $request->categorie_id,  
            'fournisseur_id' => $request->fournisseur_id,
            'quantite_stock' => $request->quantite_stock,
            'prix_achat' => $request->prix_achat,
            'prix_vente' => $request->prix_vente,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit créé avec succès.');
    }

    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        $fournisseurs = Fournisseur::all();
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'fournisseurs', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'reference' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id', 
            'fournisseur_id' => 'required|exists:fournisseurs,id',  
            'quantite_stock' => 'required|integer|min:0',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0|gt:prix_achat',  
        ], [
            'categorie_id.required' => 'La catégorie est obligatoire.',
            'prix_vente.gt' => 'Le prix de vente doit être supérieur au prix d\'achat.',
        ]);

        $produit->update([
            'reference' => $request->reference,
            'marque' => $request->marque,
            'categorie_id' => $request->categorie_id,
            'fournisseur_id' => $request->fournisseur_id,
            'quantite_stock' => $request->quantite_stock,
            'prix_achat' => $request->prix_achat,
            'prix_vente' => $request->prix_vente,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
