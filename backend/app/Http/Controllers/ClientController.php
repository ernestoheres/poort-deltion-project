<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Intervention\Image\Facades\Image;
class ClientController extends Controller
{
    public function getAllClients()
    {
        $clients = Client::all();
        return response($clients, 200);
    }

    public function getClientById($id) {
        $client = Client::find($id);
        return response($client, 200);
    }

    public function createClient(Request $request) {
        $data = [
            "voornaam" => $request->voornaam,
            "tussenvoegels" => $request->tussenvoegels,
            "achternaam" => $request->achternaam,
            "adres" => $request->adres,
            "postcode" => $request->postcode,
            "woonplaats" => $request->woonplaats,
            "land" => $request->land,
            "telefoon" => $request->telefoon,
            "bsn" => $request->bsn,
            "vezekering" => $request->vezekering,
            "polisnummer" => $request->polisnummer,
        ];

        Client::create($data);
        return response("Client created", 201);
    }

    public function serveImage($id) {
        $client = Client::find($id);
        $path = storage_path('app/img/' . $client->profielfoto . '.jpg');
        $img = Image::make($path);
        return $img->response();
    }
}
