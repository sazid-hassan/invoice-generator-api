<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_contact',
        'amount',
        'due',
        'paid',
        'status',
        'date',
        'note',
    ];

    protected static function booted()
    {
        static::creating(function ($invoice) {
            do {
                $invoiceNumber = 'INV-' . strtoupper(Str::random(8));
            } while (self::where('invoice_number', $invoiceNumber)->exists());

            $invoice->invoice_number = $invoiceNumber;
        });
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters->filled('status')) {
            $query->where('status', $filters->status);
        }

        if ($filters->filled('from') && $filters->filled('to')) {
            $query->whereBetween('created_at', [$filters->from, $filters->to]);
        }

        if ($filters->filled('min') && $filters->filled('max')) {
            $query->whereBetween('amount', [$filters->min, $filters->max]);
        }

        return $query;
    }
}
