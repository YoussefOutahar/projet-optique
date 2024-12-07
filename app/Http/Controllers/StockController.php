<?php
namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('produit.categorie')->paginate(10);
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $produits = Produit::with('categorie')->get();
        $stockMinimum = 10; 
        $stockMaximum = 100; 

        return view('stocks.create', compact('produits', 'stockMinimum', 'stockMaximum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'stock_min' => 'required|integer|min:1|lte:stock_max',
            'stock_max' => 'required|integer|min:1|gte:stock_min',
            'stock_reel' => 'required|integer|min:0',
            'prix_vente' => 'required|numeric|min:0',
        ], [
            'stock_min.lte' => 'Le stock minimum doit être inférieur ou égal au stock maximum.',
            'stock_max.gte' => 'Le stock maximum doit être supérieur ou égal au stock minimum.',
        ]);

        Stock::create($request->all());
        return redirect()->route('stocks.index')->with('success', 'Stock créé avec succès.');
    }

    public function show(Stock $stock)
    {
        $stock->load('produit');
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
    $produits = Produit::with('categorie')->get();
    
    $categories = Categorie::all(); 

    $stockMinimum = config('app.stock_minimum', 10);
    $stockMaximum = config('app.stock_maximum', 100);

    return view('stocks.edit', compact('stock', 'produits', 'categories', 'stockMinimum', 'stockMaximum'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'stock_min' => 'required|integer|min:1|lte:stock_max',
            'stock_max' => 'required|integer|min:1|gte:stock_min',
            'stock_reel' => 'required|integer|min:0',
            'prix_vente' => 'required|numeric|min:0',
        ], [
            'stock_min.lte' => 'Le stock minimum doit être inférieur ou égal au stock maximum.',
            'stock_max.gte' => 'Le stock maximum doit être supérieur ou égal au stock minimum.',
        ]);

        $stock->update($request->all());
        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès.');
    }
}
