<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\EyeDetail; 

class EyeDetailController extends Controller
{
    public function create(Client $client)
    {
        return view('clients.eyes', compact('client'));
    }

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'vision' => 'required|string',
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

        $client->eyeDetail()->create($request->all());

        return redirect()->route('clients.index')->with('success', 'Informations sur les yeux ajoutées avec succès.');
    }

    public function show(Client $client)
    {
        $eyeDetail = $client->eyeDetail;

        return view('clients.eye-details', compact('client', 'eyeDetail'));
    }

    public function showEyeDetailsByDate(Client $client, $date)
    {
        $parsedDate = \Carbon\Carbon::parse($date);
    
        $eyeDetails = EyeDetail::where('client_id', $client->id)
                               ->whereDate('created_at', $parsedDate)
                               ->get();
    
        return view('clients.eye-details', compact('client', 'eyeDetails', 'parsedDate'));
    }
    
}
