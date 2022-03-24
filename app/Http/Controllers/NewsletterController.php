<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\SEOTools;

class NewsletterController extends Controller
{
    public function create(Request $request)
    {
        $newsletter = Newsletter::where('email', $request->email)->where('is_available', true)->first();
        if ($newsletter != null)
        {
            return redirect('/subscripcion-previa');
        }
        $request['is_available'] = true;
        $newsletter = Newsletter::create($request->all());

        Mail::to(env('NEWSLETTER_EMAIL'))->send(new NewsletterMail($newsletter));

        return redirect('/subscripcion-exitosa');
    }
    public function success()
    {
        SEOTools::setTitle("Soluciones para Construcción");
        SEOTools::setDescription("Encuentra aquí gran variedad de marcas y productos para construir con calidad tus desarrollos habitacionales. Tinacos, cisternas, tubería, impermeabilizantes, recubrimientos, adhesivos y más.");
        SEOTools::setCanonical(env('APP_URL') . '/subscripcion-exitosa');
        return view('website.newsletter.success');
    }

    public function failure()
    {
        SEOTools::setTitle("Soluciones para Construcción");
        SEOTools::setDescription("Encuentra aquí gran variedad de marcas y productos para construir con calidad tus desarrollos habitacionales. Tinacos, cisternas, tubería, impermeabilizantes, recubrimientos, adhesivos y más.");
        SEOTools::setCanonical(env('APP_URL') . '/subscripcion-previa');
        return view('website.newsletter.failure');
    }
}
