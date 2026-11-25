<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/** Usuario de AyniHub. Roles: comprador, productor, gestor. */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = ['name', 'contact', 'email', 'password', 'role', 'location'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /** Correo en minúsculas; celular solo con dígitos (y + inicial). */
    public static function normalizeContact(string $contact): string
    {
        $contact = trim($contact);

        if (str_contains($contact, '@')) {
            return mb_strtolower($contact);
        }

        return preg_replace('/[^\d+]/', '', $contact) ?? $contact;
    }

    /** Datos que el navegador puede conocer (nunca la contraseña). */
    public function toPublicArray(): array
    {
        return [
            'id' => $this->id, 'name' => $this->name, 'contact' => $this->contact,
            'role' => $this->role, 'location' => $this->location,
        ];
    }

    /** Sección a la que se envía al usuario después de entrar. */
    public function homeHash(): string
    {
        return $this->role === 'gestor' ? '#Panel' : '#Catalogo';
    }
}
