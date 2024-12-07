<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\EyeDetail;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(4);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => ['required', 'string', 'max:20', 'unique:clients', 'regex:/^(\+212|0)[5-7]\d{8}$/'],
            'genre' => 'nullable|string|max:10',
            'cine' => 'nullable|string|max:20',
            'adresse' => 'required|string|max:255',
            'premiere_visite' => 'nullable|date',
            'derniere_visite' => 'nullable|date',
            'typeassurance' => 'nullable|string|max:50',
            'beneficiary' => 'nullable|string|max:50',
            'od_sphere' => 'nullable|string|max:10',
            'od_cylinder' => 'nullable|string|max:10',
            'od_axis' => 'nullable|string|max:10',
            'od_add' => 'nullable|string|max:10',
            'od_epi' => 'nullable|string|max:10',
            'os_sphere' => 'nullable|string|max:10',
            'os_cylinder' => 'nullable|string|max:10',
            'os_axis' => 'nullable|string|max:10',
            'os_add' => 'nullable|string|max:10',
            'os_epi' => 'nullable|string|max:10',
        ]);

        $client = new Client($request->except(['has_assurance', 'typeassurance', 'beneficiary']));

        if ($request->has_assurance === 'oui') {
            $client->typeassurance = $request->typeassurance;
            $client->beneficiary = $request->beneficiary;
        } else {
            $client->typeassurance = null;
            $client->beneficiary = null;
        }

        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => ['required', 'string', 'max:20', 'unique:clients,telephone,' . $client->id, 'regex:/^(\+212|0)[5-7]\d{8}$/'],
            'genre' => 'required|string|max:10',
            'cine' => 'required|string|max:20|unique:clients,' . $client->id,
            'adresse' => 'required|string|max:255',
            'premiere_visite' => 'nullable|date',
            'derniere_visite' => 'nullable|date',
            'typeassurance' => 'nullable|string|max:50',
            'beneficiary' => 'nullable|string|max:50',
            'nombre_visite' => 'nullable|integer',
            'od_sphere' => 'nullable|string|max:10',
            'od_cylinder' => 'nullable|string|max:10',
            'od_axis' => 'nullable|string|max:10',
            'od_add' => 'nullable|string|max:10',
            'od_epi' => 'nullable|string|max:10',
            'os_sphere' => 'nullable|string|max:10',
            'os_cylinder' => 'nullable|string|max:10',
            'os_axis' => 'nullable|string|max:10',
            'os_add' => 'nullable|string|max:10',
            'os_epi' => 'nullable|string|max:10',
        ]);

        $client->update($request->except(['has_assurance', 'typeassurance', 'beneficiary']));

        // Gestion de l'assurance
        if ($request->has_assurance === 'oui') {
            $client->typeassurance = $request->typeassurance;
            $client->beneficiary = $request->beneficiary;
        } else {
            $client->typeassurance = null;
            $client->beneficiary = null;
        }

        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function updateEyes(Request $request, Client $client)
    {
        $request->validate([
            'od_sphere' => 'nullable|string|max:10',
            'od_cylinder' => 'nullable|string|max:10',
            'od_axis' => 'nullable|string|max:10',
            'od_add' => 'nullable|string|max:10',
            'od_epi' => 'nullable|string|max:10',
            'os_sphere' => 'nullable|string|max:10',
            'os_cylinder' => 'nullable|string|max:10',
            'os_axis' => 'nullable|string|max:10',
            'os_add' => 'nullable|string|max:10',
            'os_epi' => 'nullable|string|max:10',
        ]);

        $eyeDetail = $client->eyeDetail;
        if (!$eyeDetail) {
            $eyeDetail = new EyeDetail();
            $eyeDetail->client_id = $client->id;
        }

        $eyeDetail->fill($request->only([
            'od_sphere', 'od_cylinder', 'od_axis', 'od_add', 'od_epi',
            'os_sphere', 'os_cylinder', 'os_axis', 'os_add', 'os_epi'
        ]));
        $eyeDetail->save();

        session()->flash('details_saved', true);

        return redirect()->route('clients.eyeDetails', $client->id)->with('details_saved', true);
    }

    public function showEyeDetails(Client $client)
    {
        $eyeDetailsHistory = EyeDetail::where('client_id', $client->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get()
                                        ->groupBy(function($date) {
                                            return \Carbon\Carbon::parse($date->created_at)->format('d/m/Y H:i');
                                        });

        return view('clients.eye-details', compact('client', 'eyeDetailsHistory'));
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }

    public function showEyeDetailsByDate(Client $client, $date)
    {
        $parsedDate = \Carbon\Carbon::parse($date);

        $eyeDetails = EyeDetail::where('client_id', $client->id)
                               ->whereDate('created_at', $parsedDate)
                               ->get();

        return view('clients.eye-details', compact('client', 'eyeDetails', 'parsedDate'));
    }

    public function editEyes(Client $client)
    {
        $detail = EyeDetail::where('client_id', $client->id)->latest()->first(); // Get the most recent eye detail

        return view('clients.eyes', compact('client', 'detail'));
    }
}
