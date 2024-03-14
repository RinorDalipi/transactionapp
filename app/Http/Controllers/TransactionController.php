<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request, $id)
    {
        return $this->response(
            TransactionService::getInstance()->getAll(),
            200);
    }


    public function show(Request $request, $id)
    {
        return $this->response(TransactionService::getInstance()->get($id));
    }

    public function insertUpdate(Request $request, $id = null)
    {
        $this->validate([
            'id' => 'id',
            'name',
            'config',
            'street' => 'nullable',
        ]);

        return $this->response(TransactionService::getInstance()->insertUpdate($id, TransactionController::class, $request->all()));
    }
}
