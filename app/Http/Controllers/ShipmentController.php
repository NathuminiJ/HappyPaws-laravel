<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Http\Resources\ShipmentResource;

class ShipmentController extends Controller
{
    public function index()
    {
        return ShipmentResource::collection(Shipment::all());
    }

    public function show($id)
    {
        return new ShipmentResource(Shipment::findOrFail($id));
    }
}
