<?php

namespace App\Http\Controllers;

use App\Services\ProviderService;
use Illuminate\Http\Request;

class ProviderController extends Controller
{


    public function index(Request $request, $id)
    {
        return $this->response(
            ProviderService::getInstance()->getAll(),
            200);
    }


    public function show(Request $request, $id)
    {
        return $this->response(ProviderService::getInstance()->get($id));
    }

    public function insertUpdate(Request $request, $id = null)
    {
        $this->validate([
            'id' => 'id',
            'name' => 'nullable|string',
            'config' =>'nullable|text'
        ]);

        return $this->response(ProviderService::getInstance()->insertUpdate($id, ProviderController::class, $request->all()));
    }

}
