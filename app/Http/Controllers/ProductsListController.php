<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Classification;
use App\Models\Form;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SeoPage;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

use Illuminate\Http\Request;
use stdClass;

class ProductsListController extends Controller
{

    public function index(Request $request)
    {
        SEOTools::setTitle('Distribuidor mayoreo de materiales para la construcción');
        SEOTools::setDescription('Somos el principal distribuidor mayoreo de aquaplas. Tinacos de calidad. Productos de calidad para almacenamiento. ¡Obtén información y asesoría aquí!');
        $search = ($request->search == null) ? '': $request->search ;
        $order = ($request->sort_order == null) ? '': $request->sort_order ;
        $categories = Category::orderBy('sort_order')->get();
        $brands = Brand::all();
        $subcategories  = SubCategory::all();
        $fieldOrder = ($search == '') ? 'sort_order': 'name';
        $products = Product::where('name', 'like', '%' . $search . '%')->with('category')->with('subcategory')->orderBy($fieldOrder, $order)->paginate(9);

        $form = Form::where('name', 'Formulario de cotizaciones 1')->with('questions')->first();
        $clasifications = Classification::all();
        $titleWebsite = 'Productos';
        return view('website.products.list', compact('order', 'search','categories', 'products', 'brands','subcategories', 'form', 'clasifications', 'titleWebsite'));
    }
    public function productsFilterWithClassification(Request $request, $classification, $category, $subcategory, $brand)
    {

        if (strpos($classification, 'lico') !== false) {
            SEOTools::setTitle('Venta Tanques, Tinacos y Cisternas de Almacenamiento ⭐⭐⭐⭐⭐');
            SEOTools::setDescription('Venta de tanques de almacenamiento, tinacos mayoreo, cisternas para agua, tanques pipa nodriza, tolvas, biodigestores y más.');
        } else {
            SEOTools::setTitle('Distribuidor Mayoreo de Materiales para la Construcción ⭐⭐⭐⭐⭐');
            SEOTools::setDescription('Venta mayoreo de materiales para construcción, soluciones en recubrimientos, adhesivos, boquillas, concreto decorativo, preparador de superficies, impermeabilizantes y más.');
        }
        $canonicalUrl = env('APP_URL') . '/productos/'. $classification.'/' . $category . '/' . $subcategory . '/' . $brand;
        // dd($canonicalUrl);
        SEOTools::setCanonical($canonicalUrl);

        $query = Product::select();

        $search = $request->query();

        $classification = Classification::where('name', $classification)->first();

        $contentPage = null;

        $filters = [
            'classification' => $classification,
            'category' => 'todas-las-categorias',
            'subcategory' => 'todas-las-subcategorias',
            'brand' => 'todas-las-marcas',
            'search' => null,
            'order' => null
        ];

        if ($request->query('search')) {
            $filters['search'] = $request->query('search');
        }

        if ($request->query('sort_order')) {
            $filters['order'] = $request->query('sort_order');
        }


        if (strpos($subcategory, 'todas') === false) {
            $filters['subcategory'] = $subcategory;
            $filterSubCategory = Subcategory::where('url', $subcategory)->first();
            $query->where('subcategory_id', $filterSubCategory->id);
            if($filterSubCategory != null && $contentPage == null)
                $contentPage = $filterSubCategory;
        }


        if (strpos($category, 'todas') === false) {
            $filters['category'] = $category;
            $filterCategory = Category::where('url', $category)->first();
            if ($filterCategory != null)
            {
                $query->where('category_id', $filterCategory->id);
                if ($contentPage == null)
                    $contentPage = $filterCategory;
            }

        }


        if (strpos($brand, 'todas') === false) {
            $filters['brand'] = $brand;
            $filterBrand = Brand::where('url', $brand)->first();
            $query->where('brand_id', $filterBrand->id);
            if($filterBrand != null && $contentPage == null)
                $contentPage = $filterBrand;
        }

        $search = ($request->search == null) ? '' : $request->search;
        $order = ($request->sort_order == null) ? 'ASC' : $request->sort_order;

        if ($request->sort_order) {
            $query->orderBy('name', $order);
        }else{
            $query->orderBy('sort_order');
        }

        $products = $query->get();

        if (isset($filterSubCategory)) {
            $subcategories = SubCategory::where('id', $filterSubCategory->id)->get();
        } else {
            $subcategories = $products->map(function ($product) {
                return $product->subcategory;
            })->unique()->values()->all();
        }
        if (isset($filterBrand)) {
            $brands = Brand::where('id', $filterBrand->id)->get();
        } else {
            $brands = $products->map(function ($product) {
                return $product->brand;
            })->unique()->values()->all();
        }

        $categories = Category::where('classification_id', $classification->id)
                                ->orderBy('sort_order')
                                ->get();

        $fieldOrder = ($search == '') ? 'sort_order': 'name';
        $products = $query->where('name', 'like', '%' . $search . '%')->orderBy($fieldOrder, $order)->paginate(9);

        $form = Form::where('name', 'Formulario de cotizaciones 1')->with('questions')->first();

        $clasificationsNavbar = Classification::all();

        $brandsNavbar = Brand::all();
        

        foreach ($products as $product) {
            $brandJsonLd = $product->brand ? $product->brand->name : 'Proproyectos';

            JsonLdMulti::newJsonLd()
                ->setType('Product')
                ->setImage($product->getImage())
                ->setTitle($product->name)
                ->setDescription($product->description)
                ->addValue('logo', $product->getImage())
                ->addValue('name', $product->name)
                ->addValue('sku', $product->sku)
                ->addValue('brand', $brandJsonLd)
                ->addValue(
                    'aggregateRating',
                    JsonLd::setType('AggregateRating')
                    ->addValue('@type', 'AggregateRating')
                    ->addValue('ratingValue', 5)
                    ->addValue('reviewCount', 1)
                );
        }
        if (strpos($filters['category'], 'todas') === 0) {
            if (strpos($filters['brand'], 'todas') === 0) {
                $titleWebsite = 'Productos';
            } else {
                $titleWebsite = $filters['brand'];
                $titleWebsite = ucfirst($titleWebsite);
            }
        } else {
            $titleWebsite = $filters['category'];
            $titleWebsite = ucfirst($titleWebsite);
        }
        $breadcrumbs = [
            0 => [
                'title' => ucwords($filters['classification']->name),
                'url' => '/productos/' . $filters['classification']->name,
            ],
        ];
        
        if (strpos($category, 'todas') === false) {
            
            $categoryB = [
                'title' => ucwords($filters['category']),
                'url' => '/productos/' . $filters['category']. '/todas-las-subcategorias/todas-las-marcas',
            ];
            array_push($breadcrumbs, $categoryB);
        }
        if (strpos($subcategory, 'todas') === false) {

            $subcategoryB = [
                'title' => ucwords($filters['subcategory']),
                'url' => '/productos/todas-las-categorias/' . $filters['subcategory'] . '/todas-las-marcas',
            ];
            array_push($breadcrumbs, $subcategoryB);
        }
        if (strpos($brand, 'todas') === false) {

            $brandB = [
                'title' => ucwords($filters['brand']),
                'url' => '/productos/' . $filters['classification']->name . '/todas-las-categorias/todas-las-subcategorias/' . $filters['brand'],
            ];
            array_push($breadcrumbs, $brandB);
        }

        $seoPageDefault = SeoPage::where('type', 'default')->first();
        // dd($category, $filterCategory, $subcategory, $brand);
        if (strpos($category, 'todas') === 0 && strpos($subcategory, 'todas') === 0 && strpos($brand, 'todas') === 0) {
            SEOTools::setTitle($seoPageDefault->meta_title . ' Proproyectos '. ucwords($filters['classification']->name));
            SEOTools::setDescription($seoPageDefault->meta_description . ' productos '. $filters['classification']->name);
        } else {
            $metaTitle = '';
            $metaDescription = '';
            if (strpos($category, 'todas') === false) {
                $metaTitle = $metaTitle . $filterCategory->meta_title;

                $metaDescription = $filterCategory->meta_description . $metaDescription;
            } else {
                $metaTitle = $metaTitle . $seoPageDefault->meta_title;

                $metaDescription = $seoPageDefault->meta_description . $metaDescription;
            }
            if (strpos($subcategory, 'todas') === false) {
                $metaTitle = $metaTitle . ' ' . $filterSubCategory->meta_title;

                $metaDescription = $filterSubCategory->meta_description . ' ' . $metaDescription;
            }
            if (strpos($brand, 'todas') === false) {
                $metaTitle = $metaTitle . ' ' . $filterBrand->meta_title;

                $metaDescription = $filterBrand->meta_description . ' ' . $metaDescription;;
            } else {
                $metaTitle = $metaTitle . ' Proproyectos';

                $metaDescription = 'Proproyectos ' . $metaDescription;
            }
            // dd($metaTitle, $metaDescription);

            SEOTools::setTitle($metaTitle);
            SEOTools::setDescription($metaDescription);
        }
        
        return view('website.products.list',
            compact(
                'order',
                'search',
                'clasificationsNavbar',
                'categories',
                'products',
                'brands',
                'brandsNavbar',
                'subcategories',
                'form',
                'filters',
                'titleWebsite',
                'breadcrumbs',
                'contentPage'
            )
        );
    }
    public function productsFilter(Request $request, $category, $subcategory, $brand)
    {

        $canonicalUrl = env('APP_URL') . '/productos/' . $category . '/' . $subcategory . '/' . $brand;
        SEOTools::setCanonical($canonicalUrl);

        $query = Product::select();

        $search = $request->query();

        $contentPage = null;

        $filters = [
            'classification' => null,
            'category' => 'todas-las-categorias',
            'subcategory' => 'todas-las-subcategorias',
            'brand' => 'todas-las-marcas',
            'search' => null,
            'order' => null
        ];

        if ($request->query('search')) {
            $filters['search'] = $request->query('search');
        }

        if ($request->query('sort_order')) {
            $filters['order'] = $request->query('sort_order');
        }

        if (strpos($subcategory, 'todas') === false) {
            $filters['subcategory'] = $subcategory;
            $filterSubCategory = Subcategory::where('url', $subcategory)->first();
            if ($filterSubCategory != null) {
                $query->where('subcategory_id', $filterSubCategory->id);
                if($contentPage == null)
                    $contentPage = $filterSubCategory;
            } else {
                abort(404);
            }
        }

        if (strpos($category, 'todas') === false) {
            $filters['category'] = $category;
            $filterCategory = Category::where('url', $category)->first();
            if ($filterCategory != null) {
                $query->where('category_id', $filterCategory->id);
                if($contentPage == null)
                    $contentPage = $filterCategory;
            } else {
                abort(404);
            }

        }


        if (strpos($brand, 'todas') === false) {
            $filters['brand'] = $brand;
            $filterBrand = Brand::where('url', $brand)->first();
            if ($filterBrand != null) {
                $query->where('brand_id', $filterBrand->id);
                if($contentPage == null)
                    $contentPage = $filterBrand;
            } else {
                abort(404);
            }
        }
        $search = ($request->search == null) ? '' : $request->search;
        $order = ($request->sort_order == null) ? '' : $request->sort_order;

        if ($request->sort_order) {
            $query->orderBy('name', $order);
        }else{
            $query->orderBy('sort_order');
        }

        $products = $query->get();

        if (isset($filterSubCategory)) {
            $subcategories = SubCategory::where('id', $filterSubCategory->id)->get();
        } else {
            $subcategories = $products->map(function ($product) {
                return $product->subcategory;
            })->unique()->values()->all();
        }
        if (isset($filterBrand)) {
            $brands = Brand::where('id', $filterBrand->id)->get();
        } else {
            $brands = $products->map(function ($product) {
                return $product->brand;
            })->unique()->values()->all();
        }


        if(isset($filterCategory))
        {
            if(isset($filterCategory->classification_id))
            {
                $categories = Category::where('classification_id', $filterCategory->classification_id)->orderBy('sort_order')->get();
            }else{
                $categories = Category::orderBy('sort_order')->get();
            }
        }else{
            $categories = Category::orderBy('sort_order')->get();
        }


        $fieldOrder = ($search == '') ? 'sort_order': 'name';

        if ($order == '') {
            $products = $query->where('name', 'like', '%' . $search . '%')->paginate(9);    
        } else {
            $products = $query->where('name', 'like', '%' . $search . '%')->orderBy($fieldOrder, $order)->paginate(9);
        }

        $form = Form::where('name', 'Formulario de cotizaciones 1')->with('questions')->first();

        $clasificationsNavbar = Classification::all();

        $brandsNavbar = Brand::all();

        foreach ($products as $product) {
            
                $brandJsonLd = $product->brand ? $product->brand->name : 'Proproyectos';

                JsonLdMulti::newJsonLd()
                    ->setType('Product')
                    ->setImage($product->getImage())
                    ->setTitle($product->name)
                    ->setDescription($product->description)
                    ->addValue('logo', $product->getImage())
                    ->addValue('name', $product->name)
                    ->addValue('sku', $product->sku)
                    ->addValue('brand', $brandJsonLd)
                    ->addValue('aggregateRating', 
                        JsonLd::setType('AggregateRating')
                        ->addValue('@type', 'AggregateRating')
                        ->addValue('ratingValue', 5)
                        ->addValue('reviewCount', 1)
                    );
        }

        if (strpos($filters['category'], 'todas') === 0) {
            if (strpos($filters['brand'], 'todas') === 0) {
                $titleWebsite = 'Productos';
            } else {
                $titleWebsite = $filters['brand'];
                $titleWebsite = ucfirst($titleWebsite);
            }
        } else {
            $titleWebsite = $filters['category'];
            $titleWebsite = ucfirst($titleWebsite);
        }

        $breadcrumbs = [];
        
        if (strpos($category, 'todas') === false) {

            $categoryB = [
                'title' => ucwords($filters['category']),
                'url' => '/productos/' . $filters['category'] . '/todas-las-subcategorias/todas-las-marcas',
            ];
            array_push($breadcrumbs, $categoryB);
        }
        if (strpos($subcategory, 'todas') === false) {

            $subcategoryB = [
                'title' => ucwords($filters['subcategory']),
                'url' => '/productos/todas-las-categorias/' . $filters['subcategory'] . '/todas-las-marcas',
            ];
            array_push($breadcrumbs, $subcategoryB);
        }
        if (strpos($brand, 'todas') === false) {

            $brandB = [
                'title' => ucwords($filters['brand']),
                'url' => '/productos/todas-las-categorias/todas-las-subcategorias/' . $filters['brand'],
            ];
            array_push($breadcrumbs, $brandB);
        }

        $seoPageDefault = SeoPage::where('type', 'default')->first();
        // dd($category, $filterCategory, $subcategory, $brand);
        if (strpos($category, 'todas') === 0 && strpos($subcategory, 'todas') === 0 && strpos($brand, 'todas') === 0) {
            SEOTools::setTitle($seoPageDefault->meta_title . ' Proproyectos');
            SEOTools::setDescription($seoPageDefault->meta_description . ' productos');
        } else {
            // dd($filterCategory, strpos($category, 'todas'));
            $metaTitle = '';
            $metaDescription = '';
            if (strpos($category, 'todas') === false) {
                $metaTitle = $metaTitle.$filterCategory->meta_title;

                $metaDescription = $filterCategory->meta_description.$metaDescription;
            } else {
                $metaTitle = $metaTitle . $seoPageDefault->meta_title;
                $metaDescription = $seoPageDefault->meta_description . $metaDescription;
            }
            if (strpos($subcategory, 'todas') === false) {
                $metaTitle = $metaTitle .' '. $filterSubCategory->meta_title;

                $metaDescription = $filterSubCategory->meta_description.' '. $metaDescription;
            }
            if (strpos($brand, 'todas') === false) {
                $metaTitle = $metaTitle .' '. $filterBrand->meta_title;

                $metaDescription = $filterBrand->meta_description.' '. $metaDescription;;
            } else {
                $metaTitle = $metaTitle .' Proproyectos';

                $metaDescription = 'Proproyectos '.$metaDescription;
            }
            // dd($metaTitle, $metaDescription);

            SEOTools::setTitle($metaTitle);
            SEOTools::setDescription($metaDescription);
        }
        // dd($breadcrumbs);
        return view('website.products.list',
            compact(
                'order',
                'search',
                'clasificationsNavbar',
                'categories',
                'products',
                'brands',
                'brandsNavbar',
                'subcategories',
                'form',
                'filters',
                'titleWebsite',
                'breadcrumbs',
                'contentPage'
            )
        );
    }

    public function detail($category, $subcategory, $product)
    {
        $filters = [
            'classification' => null,
            'category' => 'todas-las-categorias',
            'subcategory' => 'todas-las-subcategorias',
            'brand' => 'todas-las-marcas',
            'search' => null,
            'order' => null
        ];


        $category = Category::where('url', $category)->first();
        $subcategories = SubCategory::all();
        if ($subcategory !== "no-subcategoria") {
            $subcategory = SubCategory::where('url', $subcategory)->first();
            if ($subcategory === null) {
                return abort(404);
            }
        } else {
            $subcategory = new stdClass;
            $subcategory->name = 'no-subcategoria';
        }
        $productDetail = Product::where('url', $product)->where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->with('characteristics')->first();
        $relatedProducts = Product::where('category_id', $productDetail->category_id)->where('subcategory_id', $productDetail->subcategory_id)->orderBy('sort_order')->get();
        $specs = json_decode($productDetail->additional_characteristics, true);
        $brands = Brand::all();
        $form = Form::where('name', 'Formulario de cotizaciones 1')->with('questions')->first();

        if($category != null)
        {
            $categories = Category::where('classification_id', $category->classification_id)->orderBy('sort_order')->get();
        }else{
            $categories = Category::orderBy('sort_order')->get();
        }


        foreach ($relatedProducts as $product) {
            $brandJsonLd = $product->brand ? $product->brand->name : 'Proproyectos';

            JsonLdMulti::newJsonLd()
                ->setType('Product')
                ->setImage($product->getImage())
                ->setTitle($product->name)
                ->setDescription($product->description)
                ->addValue('logo', $product->getImage())
                ->addValue('name', $product->name)
                ->addValue('sku', $product->sku)
                ->addValue('brand', $brandJsonLd)
                ->addValue(
                    'aggregateRating',
                    JsonLd::setType('AggregateRating')
                    ->addValue('@type', 'AggregateRating')
                    ->addValue('ratingValue', 5)
                    ->addValue('reviewCount', 1)
                );
            
        }
        $brandJsonLdDetail = $productDetail->brand ? $productDetail->brand->name : 'Proproyectos';
        JsonLdMulti::newJsonLd()
            ->setType('Product')
            ->setImage($productDetail->getImage())
            ->setTitle($productDetail->name)
            ->setDescription($productDetail->description)
            ->addValue('logo', $productDetail->getImage())
            ->addValue('name', $productDetail->name)
            ->addValue('sku', $productDetail->sku)
            ->addValue('brand', $brandJsonLdDetail)
            ->addValue(
                'aggregateRating',
                JsonLd::setType('AggregateRating')
                ->addValue('@type', 'AggregateRating')
                ->addValue('ratingValue', 5)
                ->addValue('reviewCount', 1)
            );
        SEOTools::setTitle($productDetail->meta_title);
        SEOTools::setDescription($productDetail->meta_description);
        SEOTools::setCanonical(env('APP_URL') . '/productos/detalle/' . $category->url . '/' . $subcategory->url . '/' . $productDetail->url);
        $image = $productDetail->getImages();
        
        // OpenGraph::addProperty('type', 'article'); 
        // OpenGraph::setTitle($productDetail->name);
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        // OpenGraph::addImages($productDetail->getImages());

        OpenGraph::addProperty('type', 'article')
            ->addImages($productDetail->getImages())
            ->setTitle($productDetail->name)
            ->setUrl(url()->current())
            ->setSiteName('Pro Proyectos');

        // Generate html tags
        OpenGraph::generate();

        SEOMeta::addMeta('og:image:width', '640', 'property');
        SEOMeta::addMeta('og:image:height', '442', 'property');

        $breadcrumbs = [
            0 => [
                'title' => ucwords($category->name),
                'url' => '/productos/'. $category->url.'/todas-las-subcategorias/todas-las-marcas',
            ],
            1 => [
                'title' => ucwords($subcategory->name),
                'url' => '/productos/todas-las-categorias/'. $subcategory->url.'/todas-las-marcas',
            ],
            2 => [
                'title' => ucwords($productDetail->name),
                'url' => '',
                'selected' => 1
            ]
        ];

        return view('website.products.detail', compact(
            'categories',
            'filters',
            'category',
            'productDetail',
            'relatedProducts',
            'subcategories',
            'subcategory',
            'brands',
            'specs',
            'form',
            'breadcrumbs'
        ));
    }

    public function clasification(Request $request, $classification) 
    {
        // dd($classification);

        if (strpos($classification, 'lico') !== false) {
            SEOTools::setTitle('Venta Tanques, Tinacos y Cisternas de Almacenamiento ⭐⭐⭐⭐⭐');
            SEOTools::setDescription('Venta de tanques de almacenamiento, tinacos mayoreo, cisternas para agua, tanques pipa nodriza, tolvas, biodigestores y más.');
        } else {
            SEOTools::setTitle('Distribuidor Mayoreo de Materiales para la Construcción ⭐⭐⭐⭐⭐');
            SEOTools::setDescription('Venta mayoreo de materiales para construcción, soluciones en recubrimientos, adhesivos, boquillas, concreto decorativo, preparador de superficies, impermeabilizantes y más.');
        }
        // dd(env('APP_URL') . '/productos/' . $classification);
        SEOTools::setCanonical(env('APP_URL') . '/productos/'.$classification);

        $selectedClassification = Classification::where('name', $classification)->first();

        $filters = [
            'classification' => $selectedClassification,
            'category' => 'todas-las-categorias',
            'subcategory' => 'todas-las-subcategorias',
            'brand' => 'todas-las-marcas',
            'search' => null,
            'order' => null
        ];
        if ($selectedClassification != null) {
            $categoriesOfClasification = Category::where('classification_id', $selectedClassification->id)
                                    ->with('classification')
                                    ->orderBy('sort_order')
                                    ->paginate(12);
        } else {
            abort(404);
        }

        $clasifications = Classification::all();
        $brands = Brand::all();

        $breadcrumbs = [
            0 => [
                'title' => ucwords($selectedClassification->name),
                'url' => '/productos/'. $selectedClassification->name,
                'selected' => 1
            ]
        ];

        return view('website.products.clasification', 
            compact(
                'categoriesOfClasification', 
                'selectedClassification', 
                'clasifications', 
                'brands', 
                'filters',
                'breadcrumbs'
            ));
    }
}
