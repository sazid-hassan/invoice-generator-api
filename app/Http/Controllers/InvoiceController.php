<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
public function index(Request $request)
{
    $invoices = Invoice::filter($request)
        ->orderBy('created_at', 'desc') // optional: latest first
        ->paginate(15);

    return response()->json($invoices);
}


public function store(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric',
        'status' => 'required|string',
        'customer_name' => 'required|string|max:255',
        'customer_contact' => 'required|string|max:255',
        'due' => 'required|numeric',
        'paid' => 'required|numeric',
        'date' => 'required|date',
        'note' => 'nullable|string',
    ]);

    $invoice = Invoice::create($request->all());

    return response()->json($invoice, 201);
}



    public function show(Invoice $invoice)
    {
        return response()->json($invoice);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'amount' => 'sometimes|required|numeric',
            'status' => 'sometimes|required|string',
            'customer_name' => 'sometimes|required|string|max:255',
            'customer_contact' => 'sometimes|required|string|max:255',
            'due' => 'sometimes|required|numeric',
            'paid' => 'sometimes|required|numeric',
            'date' => 'sometimes|required|date',
        ]);

        $invoice->update($request->validate(
            [
                'amount' => 'sometimes|required|numeric',
                'status' => 'sometimes|required|string',
                'customer_name' => 'sometimes|required|string|max:255',
                'customer_contact' => 'sometimes|required|string|max:255',
                'due' => 'sometimes|required|numeric',
                'paid' => 'sometimes|required|numeric',
                'date' => 'sometimes|required|date',
            ]
        ));

        return response()->json($invoice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(null, 204);
    }
}
