<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            "voornaam" => "required|string",
            "tussenvoegels" => "string",
            "achternaam" => "required|string",
            "adres" => "required|string",
            "postcode" => "required|string",
            "woonplaats" => "required|string",
            "land" => "required|string",
            "telefoon" => "required|string",
            "bsn" => "required|string",
            "vezekering" => "required|string",
            "polisnummer" => "required|string",
            "email" => "required|email|",
        ]);
        


        Client::create($validated);
        $oneTimePassword = bin2hex(random_bytes(4));
        User::create([
            "email" => $validated["email"],
            "password" => bcrypt($oneTimePassword),
            "role" => "client",
            "client_id" => Client::where("email", $validated["email"])->first()->id
        ]);

        //mail functie
        $to = $validated["email"];
        $subject = "Uw account is aangemaakt";
        $message = "Uw account is aangemaakt. U kunt inloggen met uw email en het volgende wachtwoord: " . $oneTimePassword;
        $headers = "From:" . $user->email;

        mail($to, $subject, $message, $headers);
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

    public function deleteClient(Request $request, $id) {
        Client::destroy($id);
        return response("Client deleted", 200);
    }

    public function HardDeleteClient(Request $request, $id) {
        Client::withTrashed()->find($id)->forceDelete();
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

    public function uploadImage(Request $request, $id) {
        $user = $request->user();
        $client = Client::find($id);

        if($user->role == "client") {
            if($user->id != $id) {
                return response("Unauthorized", 401);
            }
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $img = Image::make($request->image->path());
        $img->encode('jpg', 75);
        
        $uuid = uniqid();
        $imageName = $uuid . '.' . 'jpg';
        Storage::disk('local')->put('img/'. $uuid . '.jpg', $img);
        $client->profielfoto = $uuid;
        $client->save();

        return response("Image uploaded", 200);

    }




}
