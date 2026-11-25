<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

/** Quién puede cambiar el estado de un pedido. */
class OrderPolicy
{
    public function changeStatus(User $user, Order $order, string $status): bool
    {
        return match ($user->role) {
            'gestor'    => true,
            'productor' => $order->producer_id === $user->id,
            // El comprador solo puede cancelar su propio pedido mientras está pendiente.
            'comprador' => $order->user_id === $user->id && $status === 'cancelado' && $order->status === 'pendiente',
            default     => false,
        };
    }
}
