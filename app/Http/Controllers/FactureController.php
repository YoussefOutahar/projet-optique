<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Client;
use App\Models\Caisse;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index(Request $request)
{
    $factures = Facture::query();

    if ($request->has('start_date') && $request->has('end_date')) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        if (strtotime($start_date) && strtotime($end_date)) {
            $factures->whereBetween('date_facture', [$start_date, $end_date]);
        }
    }

    $factures = $factures->paginate(5);

    $caisses = Caisse::paginate(5);

    return view('factures.index', compact('factures', 'caisses'));
}
    public function storeCaisse(Request $request)
    {
        $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'date_facture' => 'required|date',
            'status' => 'required|string|max:20',
            'client_id' => 'required|exists:clients,id',
            'paiement' => 'required|numeric',
        ]);

        Caisse::create($request->all());
        return redirect()->route('factures.index')->with('success', 'Caisse créée avec succès.');
    }

    public function showCaisse($id)
    {
        $caisse = Caisse::findOrFail($id);
        return view('caisses.show', compact('caisse'));
    }

    public function editCaisse($id)
    {
        $caisse = Caisse::findOrFail($id);
        $factures = Facture::all();
        $clients = Client::all();
        return view('caisses.edit', compact('caisse', 'factures', 'clients'));
    }

    public function updateCaisse(Request $request, $id)
    {
        $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'date_facture' => 'required|date',
            'status' => 'required|string|max:20',
            'client_id' => 'required|exists:clients,id',
            'paiement' => 'required|numeric',
        ]);

        $caisse = Caisse::findOrFail($id);
        $caisse->update($request->all());

        return redirect()->route('factures.index')->with('success', 'Caisse mise à jour avec succès.');
    }

    public function destroyCaisse($id)
    {
        $caisse = Caisse::findOrFail($id);
        $caisse->delete();
        return redirect()->route('factures.index')->with('success', 'Caisse supprimée avec succès.');
    }

    public function create()
    {
        $clients = Client::all();
        return view('factures.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_facture' => 'required|string|max:255',
            'date_facture' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'vente_id' => 'required|string|max:255',
            'status' => 'required|string|max:20',
            'total' => 'required|numeric',
            'remise' => 'nullable|numeric',
            'avance' => 'nullable|numeric',
            'reste_a_payer' => 'nullable|numeric',
            'responsable' => 'required|string|max:255',
        ]);

        Facture::create($request->all());

        return redirect()->route('factures.index')->with('success', 'Facture créée avec succès.');
    }

    public function show(Facture $facture)
    {
        $facture->load('vente.client'); 
        return view('factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        $clients = Client::all();
        return view('factures.edit', compact('facture', 'clients'));
    }

    public function update(Request $request, Facture $facture)
    {
        $validated = $request->validate([
            'numero_facture' => 'required|string|max:255',
            'date_facture' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|string|max:20',
            'total' => 'required|numeric',
            'remise' => 'nullable|numeric',
            'avance' => 'nullable|numeric',
            'reste_a_payer' => 'nullable|numeric',
            'responsable' => 'required|string|max:255',
        ]);

        $facture->update($validated);

        return redirect()->route('factures.index')->with('success', 'Facture mise à jour avec succès.');
    }

    public function print($id)
    {
        $facture = Facture::with('vente.produits')->findOrFail($id); // Charger les produits via la vente
        return view('factures.print', compact('facture'));
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();

        return redirect()->route('factures.index')->with('success', 'Facture supprimée avec succès.');
    }
}
