<?php
/**
 * @see https://github.com/artesaos/seotools
 */

// use App\Models\SeoPage;

// $seoPageDefault = SeoPage::where('type', 'default')->first();
// if ($seoPageDefault != null) {
//     $commonTitle = $seoPageDefault->meta_title;
//     $commonDescription = $seoPageDefault->meta_description;    
// } else {
// }


$commonTitle = 'Distribuidor mayoreo de materiales para la construcción';
$commonDescription = 'Somos el principal distribuidor mayoreo de aquaplas. Tinacos de calidad. Productos de calidad para almacenamiento. ¡Obtén información y asesoría aquí!';

$commonUrl = env('APP_URL');
$images = [
    env('APP_URL') . '/img/tecnotanques/preview-proproyectos-min.jpg',
];

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => '',
            'titleBefore'  => false,
            'description'  => $commonDescription,
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => $commonUrl, // Set null for using Url::current(), set false to total remove
            'robots'       => 'all', // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => $commonTitle, // set false to total remove
            'description' => $commonDescription, // set false to total remove
            'url'         => $commonUrl, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => $images,
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => $commonTitle, // set false to total remove
            'description' => $commonDescription, // set false to total remove
            'url'         => $commonUrl, // Set null for using Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => $images,
        ],
    ],
];
