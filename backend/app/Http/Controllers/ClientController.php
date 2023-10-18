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

    public function updateClient(Request $request, $id) {
        $user = $request->user();
        $client = Client::find("id", $id);

        $data = [
            "voornaam" => $request->voornaam || $client->voornaam,
            "tussenvoegels" => $request->tussenvoegels  || $client->tussenvoegsels,
            "achternaam" => $request->achternaam  || $client->achternaam,
            "adres" => $request->adres || $client->adres,
            "postcode" => $request->postcode || $client->postcode,
            "woonplaats" => $request->woonplaats || $client->woonplaats,
            "land" => $request->land || $client->land,
            "telefoon" => $request->telefoon || $client->telefoon,
            "bsn" => $request->bsn || $client->bsn,
            "vezekering" => $request->vezekering || $client->vezekering,
            "polisnummer" => $request->polisnummer || $client->polisnummer,
        ];


    }

    public function deleteClient($id) {
        Client::destroy($id);
        return response("Client deleted", 200);
    }

    public function getSoftDeletedClients() {
        $clients = Client::onlyTrashed()->get();
        return response($clients, 200);
    }

    public function serveImage($id) {
        $client = Client::find($id);
        $path = storage_path('app/img/' . $client->profielfoto . '.jpg');
        //check if file exists at path
        if (!file_exists($path)) {
            $path = storage_path('app/img/default.jpg');
        }
        $img = Image::make($path);
        return $img->response();
    }
}
