<?php

namespace App\Providers;

use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\CatalogDownload;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\DataCollection;
use App\Models\Form;
use App\Models\Group;
use App\Models\LegalDocument;
use App\Models\Option;
use App\Models\Product;
use App\Models\ProductCharacteristic;
use App\Models\Resource;
use App\Policies\AttributePolicy;
use App\Policies\BannerPolicy;
use App\Policies\BrandPolicy;
use App\Policies\CatalogDownloadPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\DataCollectionPolicy;
use App\Policies\FormPolicy;
use App\Policies\GroupPolicy;
use App\Policies\LegalDocumentPolicy;
use App\Policies\OptionPolicy;
use App\Policies\ProductCharacteristicPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ResourcePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Brand::class => BrandPolicy::class,
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        LegalDocument::class => LegalDocumentPolicy::class,
        Group::class => GroupPolicy::class,
        Form::class => FormPolicy::class,
        DataCollection::class => DataCollectionPolicy::class,
        Characteristic::class => ProductCharacteristicPolicy::class,
        Resource::class => ResourcePolicy::class,
        Attribute::class => AttributePolicy::class,
        Option::class => OptionPolicy::class,
        CatalogDownload::class => CatalogDownloadPolicy::class,
        Banner::class => BannerPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
