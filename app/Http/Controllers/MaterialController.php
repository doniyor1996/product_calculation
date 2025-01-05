<?php

namespace App\Http\Controllers;

use App\Models\Material;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Material::class, 'material');
    }
}
