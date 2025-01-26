<?php

return [
    'files' => [
        [
            'url' => 'https://docs.google.com/spreadsheets/d/?id_example?/edit',
            'tabs' => [\App\DTO\FileConfigDTO::TABS_ALL],
            'tables' => [
                'example_table' => ['date', 'продукт'=>'product_name', 'price', 'amount'],
                'example_table_second' => ['field'=>'date', 'продукт'=>'product_name'],
                'example_table_third' => ['price', 'amount'],
            ],
        ],
        [
            'url' => 'https://docs.google.com/spreadsheets/d/?id_example?/edit?gid=0#gid=0',
            'tabs' => ['Sheet1!D3'],
            'tables' => [
                'example_table' => ['count', 'product_name', 'price', 'amount'],
                'example_table_second' => ['trust', 'product_name'],
                'example_table_third' => ['test', 'amount'],
            ],
        ],
    ]
];
