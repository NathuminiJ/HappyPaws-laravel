<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Resources\SubscriptionResource;

class SubscriptionController extends Controller
{
    public function index()
    {
        return SubscriptionResource::collection(
            Subscription::with('customer')->get()
        );
    }

    public function show($id)
    {
        return new SubscriptionResource(
            Subscription::with('customer')->findOrFail($id)
        );
    }
}
