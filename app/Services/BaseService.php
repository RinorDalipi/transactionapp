<?php

namespace App\Services;

use Illuminate\Support\Arr;

class BaseService
{
    protected function findOrNew($id, $modelClass)
    {
        return $id ? $modelClass::findOrFail($id) : new $modelClass();
    }

    protected function findOrCreateWithFill($id, $modelClass, array $attributes)
    {
        $model = $this->findOrNew($id, $modelClass);
        $model->fill(Arr::only($attributes, $model->getFillable()));

        return $model;
    }

    public function insertUpdate($id, $modelClass, array $attributes,  $supplierId= null)
    {
        $model = $this->findOrCreateWithFill($id, $modelClass, $attributes);
        if ($supplierId) {
            $model->supplier_id = $supplierId;
        }
        $model->save();

        return $model;
    }

}
