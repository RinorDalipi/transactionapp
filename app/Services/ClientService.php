<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Provider;
use Illuminate\Support\Arr;

class ClientService extends BaseService
{
    private static self|null $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }


    public function get($id, $with = [])
    {
        return Client::query()
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getAll($with = [])
    {
        return Client::query()->get();
    }

    public function upsert($id, $data): Client
    {
        return $this->insertUpdate($id, Client::class, $data);
    }

}
