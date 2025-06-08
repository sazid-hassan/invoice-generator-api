<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::query();
        if($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if($request->filled(('from')) && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        if ($request->filled('min') && $request->filled('max')) {
            $query->whereBetween('amount', [$request->min, $request->max]);
        }

        return $query->get();
    }

    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
