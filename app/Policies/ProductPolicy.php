<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

/** Quién puede crear, editar o borrar productos. */
class ProductPolicy
{
    public function create(User $user): bool
    {
        return in_array($user->role, ['productor', 'gestor'], true);
    }

    public function update(User $user, Product $product): bool
    {
        return $user->role === 'gestor' || ($user->role === 'productor' && $user->id === $product->user_id);
    }

    public function delete(User $user, Product $product): bool
    {
        return $this->update($user, $product);
    }
}
