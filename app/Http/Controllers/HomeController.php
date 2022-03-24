<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Classification;
use App\Models\LegalDocument;
use App\Models\Product;
use App\Models\SeoPage;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Illuminate\Http\Request;
use Browser;

class HomeController extends Controller
{

    public function index()
    {

        $modalNewsletters = Banner::where('is_active', true)->orderBy('sort_order', 'desc')->get();


        
        $seoPage = SeoPage::where('type', 'home')->first();
        $seoPageDefault = SeoPage::where('type', 'default')->first();
        if($seoPage != null)
        {
            SEOTools::setTitle($seoPage->meta_title);
            SEOTools::setDescription($seoPage->meta_description);
        }else
        {
            if ($seoPageDefault != null) {
                SEOTools::setTitle($seoPageDefault->meta_title);
                SEOTools::setDescription($seoPageDefault->meta_description);
            } else {
                SEOTools::setTitle("Proveedores Mayoristas para Construcción");
                SEOTools::setDescription("Venta de productos hidráulicos y recubrimientos para la industria de la construcción a los mejores precios de mayoreo.  Ofrecemos calidad en marcas y asesoría especializada.");
            }
        }
        
        SEOTools::setCanonical(env('APP_URL') . '/');
        if (\Illuminate\Support\Facades\Blade::check('browser', 'isSafari')) {
            $services = [
                0 => [
                    'gif' => '/img/tecnotanques/04.gif',
                    'content' => 'Solución integral en tus productos de construcción.',
                ],
                1 => [
                    'gif' => '/img/tecnotanques/03.gif',
                    'content' => 'Entrega a domicilio con envíos a todo el territorio Nacional.',
                ],
                2 => [
                    'gif' => '/img/tecnotanques/02.gif',
                    'content' => 'Servicio y asesoría personalizada.',
                ],
                3 => [
                    'gif' => '/img/tecnotanques/05.gif',
                    'content' => 'Cotiza ya.',
                ],
            ];
        } else {
            $services = [
                0 => [
                    'gif' => '/animations/solucion-integral.webm',
                    'content' => 'Solución integral en tus productos de construcción.',
                ],
                1 => [
                    'gif' => '/animations/entrega-a-domicilio.webm',
                    'content' => 'Entrega a domicilio con envíos a todo el territorio Nacional.',
                ],
                2 => [
                    'gif' => '/animations/servicio-personalizado.webm',
                    'content' => 'Servicio y asesoría personalizada.',
                ],
                3 => [
                    'gif' => '/animations/cotiza-ya.webm',
                    'content' => 'Cotiza ya.',
                ],
            ];
        }

        $productsImg = [
            0 => [
                'id' => 1,
                'title' => 'materiales de construcción',
                'name' => 'construccion',
                'uri' => '/img/tecnotanques/productos-1.jpg',
                'color' => 'bg-primary'
            ],
            1 => [
                'id' => 2,
                'name' => 'hidraulico',
                'title' => 'material hidráulico',
                'uri' => '/img/tecnotanques/productos-2.jpg',
                'color' => 'bg-secondary-100'
            ],
        ];

        foreach ($productsImg as $product) {
            JsonLdMulti::newJsonLd()
                ->setType('Service')
                ->addValue('image', env('APP_URL') . $product['uri'])
                ->addValue('name', $product['title']);
        }

        $homeProducts = Product::where('show_in_home', true)->get();
        return view('website.home', compact('services', 'productsImg', 'modalNewsletters', 'homeProducts'));
    }

    public function legalDocuments($document)
    {
        $document = LegalDocument::where('url', $document)->first();

        return view('website.legal', compact('document'));
    }
}
