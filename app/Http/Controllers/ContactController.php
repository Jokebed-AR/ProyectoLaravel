<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Brand;
use App\Models\Classification;
use App\Models\Contact;
use App\Models\Product;
use App\Models\ProductContact;
use App\Models\SeoPage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function index()
    {

        $seoPage = SeoPage::where('type', 'contact')->first();
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

        SEOTools::setCanonical(env('APP_URL') . '/contacto');
        $products = Product::orderBy('name')->get();
        // dd($products);
        $breadcrumbs = [
            0 => [
                'title' => 'Contacto',
                'url' => '/contacto',
                'selected' => 1
            ]
        ];
        return view('website.contact', compact('products', 'breadcrumbs'));
    }

    public function create(ContactRequest $request)
    {
        $contact = Contact::where('email', $request->email)->orderBy('created_at', 'desc')->first();
        $prodContact = null;
        if ($contact != null && false)
        {
            $now = Carbon::now();
            $time = $now->diffInMinutes($contact->created_at);
            if ($time <= 30) {
                return view('website.contact.failure');
            }
        }

        $contact = Contact::create($request->all());

        if ($request->product_id) {
            $prodContact = ProductContact::create([
                'product_id' => $request->product_id,
                'contact_id' => $contact->id
            ]);
            $contact['product'] = $prodContact->product->name;
        }

        Mail::to(env('CONTACT_EMAIL'))->send(new ContactMail($contact));

        if($prodContact != null)
            return redirect('/contacto-exitoso/' .  $prodContact->product->name);
        else
            return redirect('/contacto-exitoso');
    }

    public function success($product = null) {
        if ( Product::where('name', 'like', '%' . $product . '%')->exists()) {
            SEOTools::setCanonical(env('APP_URL') . '/contacto-exitoso'. $product);
            SEOTools::setTitle("Soluciones para Construcción");
            SEOTools::setDescription("Encuentra aquí gran variedad de marcas y productos para construir con calidad tus desarrollos habitacionales. Tinacos, cisternas, tubería, impermeabilizantes, recubrimientos, adhesivos y más.");
            return view('website.contact.success');
        }
        else
        {
            SEOTools::setCanonical(env('APP_URL') . '/contacto-exitoso');
            SEOTools::setTitle("Soluciones para Construcción");
            SEOTools::setDescription("Encuentra aquí gran variedad de marcas y productos para construir con calidad tus desarrollos habitacionales. Tinacos, cisternas, tubería, impermeabilizantes, recubrimientos, adhesivos y más.");
            return view('website.contact.success');
        }
    }

    public function back() {
        return redirect()->back();
    }
}
