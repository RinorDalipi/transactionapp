<?php

namespace App\Services;

use App\Enums\AssignableType;
use App\Enums\MaintenanceStatus;
use App\Enums\OneWayStrategy;
use App\Enums\ReservationStatus;
use App\Exceptions\Assignments\CarInDifferentZoneException;
use App\Exceptions\Assignments\CarNotAvailableInPeriodException;
use App\Exceptions\Assignments\FutureCarGroupConflict;
use App\Exceptions\Assignments\MaintenanceWithinOnGoingReservation;
use App\Models\Assignment;
use App\Models\AssignmentCarCheck;
use App\Models\Internal;
use App\Models\Maintenance;
use App\Models\Reservation;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TransactionService extends BaseService
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
        return Transaction::query()
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getAll($with = [])
    {
        return Transaction::query()
            ->get()
            ->all();
    }

    public function upsert($supplierId, $id, $data): Transaction
    {
        return $this->insertUpdate($id, Transaction::class, $data);
    }

}
