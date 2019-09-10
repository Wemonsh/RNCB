<?php
return [
// [Main Controller]
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

// [Account Controller]

// Страницы Account Controller
// Страница авторизации
    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],
// Страница регистрации
    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],
// Страница профиля
    'account/profile' => [
        'controller' => 'account',
        'action' => 'profile',
    ],
    'account/profile/{id:\d+}' => [
        'controller' => 'account',
        'action' => 'profile',
    ],
// Страница настроек
    'account/settings' => [
        'controller' => 'account',
        'action' => 'settings',
    ],
// Страница с документами
    'account/documents' => [
        'controller' => 'account',
        'action' => 'documents',
    ],
// Страница телефонного справочника
    'account/phones' => [
        'controller' => 'account',
        'action' => 'phones',
    ],
// Страница всех пользователей
    'account/show' => [
        'controller' => 'account',
        'action' => 'show',
    ],

    'account/reset' => [
        'controller' => 'account',
        'action' => 'reset',
    ],

// Функции Account Controller
// Функция деавторизации пользователя
    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],
// Функиця обновления пароля
    'account/update-password' => [
        'controller' => 'account',
        'action' => 'update_password',
    ],
// Функция обновления Email адреса
    'account/update-email' => [
        'controller' => 'account',
        'action' => 'update_email',
    ],
// Функция обновления телефонного номера
    'account/update-phone' => [
        'controller' => 'account',
        'action' => 'update_phone',
    ],
// Функция обновления фотографии
    'account/update-photo' => [
        'controller' => 'account',
        'action' => 'update_photo',
    ],

// [News Controller]

    'news/show' => [
        'controller' => 'news',
        'action' => 'show',
    ],

    'news/add' => [
        'controller' => 'news',
        'action' => 'add',
    ],

    'news/post/{id:\d+}' => [
        'controller' => 'news',
        'action' => 'post',
    ],

// [Requests Controller]

    'requests/history' => [
        'controller' => 'requests',
        'action' => 'history',
    ],

    'requests/history/{page:\d+}' => [
        'controller' => 'requests',
        'action' => 'history',
    ],

    'requests/log/' => [
        'controller' => 'requests',
        'action' => 'log',
    ],

    'requests/create' => [
        'controller' => 'requests',
        'action' => 'create',
    ],

    'requests/my' => [
        'controller' => 'requests',
        'action' => 'my',
    ],

    'requests/all' => [
        'controller' => 'requests',
        'action' => 'all',
    ],

    'requests/all/{page:\d+}' => [
        'controller' => 'requests',
        'action' => 'all',
    ],

    'requests/open' => [
        'controller' => 'requests',
        'action' => 'open',
    ],

    'requests/open/{page:\d+}' => [
        'controller' => 'requests',
        'action' => 'open',
    ],

    'requests/inwork' => [
        'controller' => 'requests',
        'action' => 'inwork',
    ],

    'requests/inwork/{page:\d+}' => [
        'controller' => 'requests',
        'action' => 'inwork',
    ],

    'requests/statistics' => [
        'controller' => 'requests',
        'action' => 'statistics',
    ],

    'requests/closed' => [
        'controller' => 'requests',
        'action' => 'closed',
    ],

    'requests/frozen' => [
        'controller' => 'requests',
        'action' => 'frozen',
    ],

    'requests/request/{id:\d+}' => [
        'controller' => 'requests',
        'action' => 'request',
    ],

    'requests/get/{id:\d+}' => [
        'controller' => 'requests',
        'action' => 'get',
    ],

    'requests/froze/{id:\d+}' => [
        'controller' => 'requests',
        'action' => 'froze',
    ],

    'requests/close/{id:\d+}' => [
        'controller' => 'requests',
        'action' => 'close',
    ],

    'requests/back/{id:\d+}' => [
        'controller' => 'requests',
        'action' => 'back',
    ],

    'requests/defrosting/{id:\d+}' => [
        'controller' => 'requests',
        'action' => 'defrosting',
    ],

    'requests/my_in_work' => [
        'controller' => 'requests',
        'action' => 'my_in_work',
    ],

    'requests/my_closed' => [
        'controller' => 'requests',
        'action' => 'my_closed',
    ],

    'requests/my_frozen' => [
        'controller' => 'requests',
        'action' => 'my_frozen',
    ],

    'requests/my_in_work/{page:\d+}' => [
        'controller' => 'requests',
        'action' => 'my_in_work',
    ],

    'requests/send/{id:\d+}' => [
        'controller' => 'requests',
        'action' => 'send',
    ],

    'requests/my_closed/{page:\d+}' => [
        'controller' => 'requests',
        'action' => 'my_closed',
    ],

    'requests/my_frozen/{page:\d+}' => [
        'controller' => 'requests',
        'action' => 'my_frozen',
    ],

// [Information Controller]

    'information/list' => [
        'controller' => 'information',
        'action' => 'list',
    ],

    'information/list/{page:\d+}' => [
        'controller' => 'information',
        'action' => 'list',
    ],

    'information/add' => [
        'controller' => 'information',
        'action' => 'add',
    ],

    'information/search' => [
        'controller' => 'information',
        'action' => 'search',
    ],

// [Services Controller]

// Страница с выводом данных об умерших
    'services/death' => [
        'controller' => 'services',
        'action' => 'death',
    ],

    'services/death/{page:\d+}' => [
        'controller' => 'services',
        'action' => 'death',
    ],

    'services/death/search' => [
        'controller' => 'services',
        'action' => 'd_search',
    ],


    'admin/dashboard' => [
        'controller' => 'admin',
        'action' => 'dashboard',
    ],

    'admin/import-users' => [
    'controller' => 'admin',
    'action' => 'import_users',
],

    'admin' => [
        'controller' => 'admin',
        'action' => 'main',
    ],

    'documents/conclusion' => [
        'controller' => 'admin',
        'action' => 'conclusion',
    ],

    'documents/order' => [
        'controller' => 'admin',
        'action' => 'order',
    ],
];