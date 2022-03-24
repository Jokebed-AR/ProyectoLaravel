<?php

namespace App\Http\Controllers;

use App\Models\CatalogDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class ApiCatalogController extends Controller
{
    public function create(Request $request)
    {
        CatalogDownload::create($request->all());
        return 200;
    }
}
