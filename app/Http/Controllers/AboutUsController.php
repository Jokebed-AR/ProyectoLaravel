<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Classification;
use App\Models\SeoPage;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{

    public function index()
    {

        $seoPage = SeoPage::where('type', 'ours')->first();
        $seoPageDefault = SeoPage::where('type', 'default')->first();
        if ($seoPage != null) {
            SEOTools::setTitle($seoPage->meta_title);
            SEOTools::setDescription($seoPage->meta_description);
        } else {
            if ($seoPageDefault != null) {
                SEOTools::setTitle($seoPageDefault->meta_title);
                SEOTools::setDescription($seoPageDefault->meta_description);
            } else {
                SEOTools::setTitle("Proveedores Mayoristas para Construcción");
                SEOTools::setDescription("Venta de productos hidráulicos y recubrimientos para la industria de la construcción a los mejores precios de mayoreo.  Ofrecemos calidad en marcas y asesoría especializada.");
            }
        }

        SEOTools::setCanonical(env('APP_URL') . '/nosotros');
        $brands = Brand::all();

        foreach ($brands as $brand) {
            JsonLdMulti::newJsonLd()
                ->setType('Brand')
                ->addValue('logo', $brand->getImage())
                ->addValue('name', $brand['name']);
        }
        $breadcrumbs = [
            0 => [
                'title' => 'Nosotros',
                'url' => '/nosotros',
                'selected' => 1
            ]
        ];
        return view('website.aboutUs', compact('breadcrumbs'));
    }
}
