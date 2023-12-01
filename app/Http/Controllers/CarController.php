<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListCarRequest;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CarController extends Controller
{
    public function __construct(
        public CarService $carService
    ) {
    }

    public function index(ListCarRequest $request): ResourceCollection
    {
        return CarResource::collection(
            $this->carService->listWithFilter($request)
        );
    }

    public function store(StoreCarRequest $request): CarResource
    {
        $car = $this->carService->create($request->validated());

        return new CarResource($car);
    }

    public function update(UpdateCarRequest $request, Car $car): CarResource
    {
        $car = $this->carService->update($car, $request->validated());

        return new CarResource($car);
    }

    public function destroy(Car $car): JsonResponse
    {
        if ($this->carService->delete($car)) {
            return response()->json(null, 204);
        } else {
            return response()->json('Server error', 500);
        }
    }

    public function destroyByType(string $type): JsonResponse
    {
        if ($this->carService->deleteFirstByType($type)) {
            return response()->json(null, 204);
        } else {
            return response()->json('Server error', 500);
        }
    }
}
