<?php

return [
    'productApiOptions' => [
        'url' => 'https://world.openfoodfacts.org/cgi/search.pl',
        'action' => 'process',
        'sortBy' => 'unique_scans_n',
        'pageSize' => 20,
        'json' => 1,
        'id' => 'id',
        'imageUrl' => 'image_url',
        'name' => 'product_name',
        'category' => 'categories'
    ]
];
