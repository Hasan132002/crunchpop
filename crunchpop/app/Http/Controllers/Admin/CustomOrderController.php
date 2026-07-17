<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrderRequest;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomOrderRequest::query()->latest();

        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        $requests = $query->paginate(15)->withQueryString();

        return view('admin.custom-orders.index', [
            'requests' => $requests,
            'statuses' => CustomOrderRequest::STATUSES,
            'current'  => $status ?? null,
        ]);
    }

    public function show(CustomOrderRequest $customOrder)
    {
        return view('admin.custom-orders.show', [
            'req'      => $customOrder,
            'statuses' => CustomOrderRequest::STATUSES,
        ]);
    }

    public function updateStatus(Request $request, CustomOrderRequest $customOrder)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', CustomOrderRequest::STATUSES)],
        ]);

        $customOrder->update($validated);

        return back()->with('success', 'Request status updated.');
    }

    public function destroy(CustomOrderRequest $customOrder)
    {
        $customOrder->delete();

        return redirect()->route('admin.custom-orders.index')
            ->with('success', 'Request deleted.');
    }
}
