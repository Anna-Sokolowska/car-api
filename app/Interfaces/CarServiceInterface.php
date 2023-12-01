<?php

namespace App\Interfaces;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CarServiceInterface
{
    public function listWithFilter(Request $request): Collection;

    public function create(array $data): Car;

    public function update(Car $car, array $data): ?Car;

    public function delete(Car $car): ?bool;

    public function deleteFirstByType(string $type): ?bool;
}
