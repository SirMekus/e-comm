<?php

namespace App\Http\Controllers;

use App\Models\PayableItem;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreatePayableItemRequest;

class PayableItemController extends Controller
{
    public function index()
    {
        return PayableItem::orderBy("created_at", "desc")->get();
    }

    public function show(?PayableItem $product=null)
    {
        return view('welcome',[
            'action'=>$product ? route('update',$product) : route('submit'),
            'actionText'=>$product ? "Update" : "Create",
            'item'=>$product,
        ]);
    }

    public function create(CreatePayableItemRequest $request)
    {
        $validated = $request->validated();

        $item = PayableItem::create($validated);

        Storage::put("product_{$item->uuid}.json", json_encode($item->toArray()));

        return response()->json([
            'event'=>"create",
            'message'=>"Product was successfully created",
            'data'=>$item
        ]);
    }

    public function update(PayableItem $product, CreatePayableItemRequest $request)
    {
        $validated = $request->validated();

        $product->update($validated);

        $item = $product->fresh();

        Storage::put("product_{$item->uuid}.json", json_encode($item->toArray()));

        return response()->json([
            'event'=>"update",
            'message'=>"Product was successfully updated",
            'data'=>$item
        ]);
    }
}
