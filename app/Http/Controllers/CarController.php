<?php

namespace App\Http\Controllers;

use App\Casts\Lowercase;
use App\Casts\Uppercase;
use App\Http\Requests\DestroyCarRequest;
use App\Http\Requests\ListCarRequest;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;

class CarController extends Controller
{
    public function index(ListCarRequest $request)
    {
        return Car::query()
            ->when($request->type, function ($query) use ($request){
                $query->where('type', $request->type);
            })
            ->when($request->limit, function ($query) use ($request){
                $query->limit($request->limit);
            })
            ->when($request->name_format, function ($query) use ($request){
                if ($request->name_format == 'uppercase')
                    $query->withCasts(['name' => Uppercase::class]);
                elseif ($request->name_format == 'lowercase')
                    $query->withCasts(['name' => Lowercase::class]);
            })
            ->paginate(5);
    }

    public function show(Car $car)
    {
        //
    }

    public function store(StoreCarRequest $request)
    {
        $car = $request->validated();

        return Car::create($car);
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $validated = $request->validated();

        return $car->update($validated);
    }

    public function destroy(DestroyCarRequest $request, Car $car)
    {
        return $car->delete();
    }

}
