<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function getAllClients()
    {
        $clients = Client::all();
        return response($clients, 200);
    }
}
