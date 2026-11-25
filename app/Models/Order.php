<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public const STATUSES = ['pendiente', 'confirmado', 'enviado', 'entregado', 'cancelado'];

    protected $fillable = [
        'user_id', 'product_id', 'producer_id', 'product_name', 'unit', 'unit_price',
        'quantity', 'total', 'status', 'note',
    ];

    protected $attributes = ['status' => 'pendiente'];

    protected function casts(): array
    {
        return ['unit_price' => 'decimal:2', 'total' => 'decimal:2', 'quantity' => 'integer'];
    }

    /** Comprador que hizo el pedido. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Productor dueño del producto pedido. */
    public function producer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'producer_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
