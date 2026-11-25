<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/** Controlador base: habilita $this->authorize() (Policies) en los demás controladores. */
abstract class Controller
{
    use AuthorizesRequests;
}
