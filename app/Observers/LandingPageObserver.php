<?php

namespace App\Observers;

use App\Helpers\SeoSlugConvert;
use App\Models\LandingPage;

class LandingPageObserver
{
    /**
     * Handle the Sector "creating" event.
     *
     * @param  \App\Models\LandingPage  $sector
     * @return void
     */
    public function creating(LandingPage $sector)
    {
        $sector->seo_name = (new SeoSlugConvert())->convert($sector->title);
    }

    /**
     * Handle the Sector "updating" event.
     *
     * @param  \App\Models\LandingPage  $sector
     * @return void
     */
    public function updating(LandingPage $sector)
    {
        $sector->seo_name = (new SeoSlugConvert())->convert($sector->title);
    }
}
