<?php

declare(strict_types=1);

return [
    [
        'name' => 'Dashboard',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48" fill="currentColor">
                <path d="M3 3h7v7H3V3zm9 0h9v5h-9V3zM3 13h9v8H3v-8zm11 0h7v7h-7v-7z"/>
                </svg>',
        'index_route' => 'admin.dashboard',
        'unique_name' => 'admin.dashboard',
        'sub_routes' => [
            'admin.index',
            'admin.purchase-order',
            'admin.purchase-order.details',
        ],
        'children' => [],
    ],
    [
        'name' => 'Purchase Order',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M248 0L208 0c-26.5 0-48 21.5-48 48l0 112c0 35.3 28.7 64 64 64l128 0c35.3 0 64-28.7 64-64l0-112c0-26.5-21.5-48-48-48L328 0l0 80c0 8.8-7.2 16-16 16l-48 0c-8.8 0-16-7.2-16-16l0-80zM64 256c-35.3 0-64 28.7-64 64L0 448c0 35.3 28.7 64 64 64l160 0c35.3 0 64-28.7 64-64l0-128c0-35.3-28.7-64-64-64l-40 0 0 80c0 8.8-7.2 16-16 16l-48 0c-8.8 0-16-7.2-16-16l0-80-40 0zM352 512l160 0c35.3 0 64-28.7 64-64l0-128c0-35.3-28.7-64-64-64l-40 0 0 80c0 8.8-7.2 16-16 16l-48 0c-8.8 0-16-7.2-16-16l0-80-40 0c-15 0-28.8 5.1-39.7 13.8c4.9 10.4 7.7 22 7.7 34.2l0 160c0 12.2-2.8 23.8-7.7 34.2C323.2 506.9 337 512 352 512z"/></svg>',
        'index_route' => 'admin.purchase.purchase-order',
        'unique_name' => 'admin.purchase.purchase-order',
        'sub_routes' => [
            'admin.index',
            'admin.purchase-order',
            'admin.purchase-order.details',
        ],
        'children' => [],
    ],
    [
        'name' => 'Moderators',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 0c4.6 0 9.2 1 13.4 2.9L457.7 82.8c22 9.3 38.4 31 38.3 57.2c-.5 99.2-41.3 280.7-213.6 363.2c-16.7 8-36.1 8-52.8 0C57.3 420.7 16.5 239.2 16 140c-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.8 1 251.4 0 256 0zm0 66.8l0 378.1C394 378 431.1 230.1 432 141.4L256 66.8s0 0 0 0z"/></svg>',
        'index_route' => 'admin.moderator.index',
        'unique_name' => 'admin.moderator',
        'sub_routes' => [
            'admin.moderator.index',
            'admin.moderator.create',
            'admin.moderator.edit',
        ],
        'children' => [],
    ],
];
