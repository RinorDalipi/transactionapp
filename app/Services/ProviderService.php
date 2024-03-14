<?php

namespace App\Services;

use App\Models\Provider;
use Illuminate\Support\Arr;

class ProviderService extends BaseService
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
        return Provider::query()
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getAll($with = [])
    {
        return Provider::query()
            ->get()
            ->all();
    }

    public function upsert($supplierId, $id, $data): Provider
    {
        return $this->insertUpdate($id, Provider::class, $data);
    }

}
