<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Intervention\Image\Facades\Image;
class ClientController extends Controller
{
    public function getAllClients(Request $request)
    {
        $clients = Client::all();
        return response($clients, 200);
    }

    public function getClientById(Request $request, $id) {
        $user = $request->user();
        if($user->role == "client") {
            if($user->id != $id) {
                return response("Unauthorized", 401);
            }
        }
        $client = Client::withTrashed()->find($id);
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
        $client = Client::dfind("id", $id);

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

    public function deleteClient(Request $request, $id) {
        Client::destroy($id);
        return response("Client deleted", 200);
    }

    public function restoreClient(Request $request, $id) {
        Client::withTrashed()->find($id)->restore();
        return response("Client restored", 200);
    }

    public function getSoftDeletedClients(Request $request) {
        $clients = Client::onlyTrashed()->get();
        return response($clients, 200);
    }

    public function serveImage(Request $request, $id) {
        $defaultPath = storage_path('app/img/default.jpg');

        $client = Client::withTrashed()->find($id);

        $profilePath = storage_path('app/img/' . $client->profielfoto . '.jpg');

        if(!file_exists($profilePath)) {
            return Image::make($defaultPath)->response();
        }
        return Image::make($profilePath)->response();
    }




}
