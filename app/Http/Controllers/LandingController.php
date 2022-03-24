<?php

namespace App\Http\Controllers;

use App\Helpers\LaravelMedia;
use App\Models\LandingPage;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOTools;

class LandingController extends Controller
{
    public function show($seoName)
    {
        $landingPage = LandingPage::where('seo_name', 'like', '%' . $seoName . '%')->first();
        if ($landingPage != null) {
            SEOTools::setTitle($landingPage->meta_title);
            SEOTools::setDescription($landingPage->meta_description);
        } else {
           return redirect('/');
        }
        SEOTools::setCanonical(env('APP_URL') . '/landing/' . $seoName);

        if($landingPage->is_contact)
        {
            $products = Product::orderBy('name')->get();
            return view('landing.template_2', compact('products', 'landingPage'));
        }else{
            $products = $landingPage->products;
            $relatedProducts = array_chunk($products->toArray(), 4);
            $videos = ($landingPage->video_urls != null) ? $landingPage->video_urls : [];
            $videos = array_chunk($videos, 3);
            $landingPage->image_1 = LaravelMedia::getImage($landingPage, 'image_1');
            $landingPage->image_2 = LaravelMedia::getImage($landingPage, 'image_2');
            return view('landing.template_1', compact('products', 'relatedProducts', 'landingPage', 'videos'));
        }

    }
}
