<?php

namespace App\Services;

use App\Casts\Lowercase;
use App\Casts\Uppercase;
use App\Interfaces\CarServiceInterface;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CarService implements CarServiceInterface
{
    public function listWithFilter(Request $request): Collection
    {
        return Car::query()
            ->when($request->query('type'), function ($query) use ($request){
                $query->where('type', $request->query('type'));
            })
            ->when($request->query('limit'), function ($query) use ($request){
                $query->limit($request->query('limit'));
            })
            ->when($request->query('name_format'), function ($query) use ($request){
                if ($request->query('name_format') == 'uppercase')
                    $query->withCasts(['name' => Uppercase::class]);
                elseif ($request->query('name_format') == 'lowercase')
                    $query->withCasts(['name' => Lowercase::class]);
            })
            ->get();
    }

    public function create(array $data): Car
    {
        return Car::create($data);
    }
    public function update(Car $car, array $data): ?Car
    {
        return $car->update($data);
    }
    public function delete(Car $car): ?bool
    {
        return $car->delete();
    }
    public function deleteFirstByType(string $type): ?bool
    {
        return Car::query()->where('type', $type)->limit(1)->delete();
    }
}
