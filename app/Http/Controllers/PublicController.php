<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * PublicController
 *
 * Este controlador maneja las rutas de acceso público, como la página de inicio.
 */
class PublicController extends Controller
{
    /**
     * Muestra la vista de la página principal.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Esto buscará y devolverá el archivo en: /resources/views/welcome.blade.php
        return view('welcome');
    }
}

