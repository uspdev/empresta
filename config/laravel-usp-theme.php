<?php

$submenu1 = [
    [
        'type' => 'header',
        'text' => '<i class="far fa-bookmark"></i> Categoria',
        'can' => 'admin'
    ],
    [
        'text' => '<i class="fas fa-plus-circle"></i> Cadastrar Categoria',
        'url' => config('app.url') . '/categorias/create',
        'can' => 'admin'
    ],
    [
        'text' => '<i class="fas fa-list-ul"></i> Listar Categorias',
        'url' => config('app.url') . '/categorias',
        'can' => 'admin'
    ],
    [
        'type' => 'divider',
        'can' => 'admin'
    ],
    [
        'type' => 'header',
        'text' => '<i class="fas fa-boxes"></i> Material',
        'can' => 'admin'
    ],
    [
        'text' => '<i class="fas fa-plus-circle"></i> Cadastrar Material',
        'url' => config('app.url') . '/materials/create',
        'can' => 'admin'
    ],
    [
        'text' => '<i class="fas fa-list-ul"></i> Listar Material',
        'url' => config('app.url') . '/materials',
        'can' => 'admin'
    ],
    [
        'type' => 'divider',
        'can' => 'admin'
    ],
    [
        'type' => 'header',
        'text' => '<i class="fas fa-eye"></i> Visitantes',
        'can' => 'balcão'
    ],
    [
        'text' => '<i class="fas fa-plus-circle"></i> Cadastrar Visitante',
        'url' => config('app.url') . '/visitantes/create',
        'can' => 'balcão'
    ],
    [
        'text' => '<i class="fas fa-list-ul"></i> Listar Visitantes',
        'url' => config('app.url') . '/visitantes',
        'can' => 'balcão'
    ],
    [
        'type' => 'divider',
        'can' => 'admin'
    ],
    [
        'type' => 'header',
        'text' => '<i class="fas fa-eye"></i> Usuários',
        'can' => 'admin'
    ],
    [
        'text' => '<i class="fas fa-plus-circle"></i> Cadastrar Usuário',
        'url' => config('app.url') . '/users/create',
        'can' => 'admin'
    ],
    [
        'text' => '<i class="fas fa-list-ul"></i> Listar Usuário',
        'url' => config('app.url') . '/users',
        'can' => 'admin'
    ],
];

$submenu2 = [
    [
        'text' => '<i class="fas fa-handshake"></i> Devolução',
        'url' => config('app.url') . '/emprestimos/devolucao',
        'can' => 'balcão'
    ],
    [
        'text' => '<i class="fas fa-handshake"></i> Empréstimo USP',
        'url' => config('app.url') . '/emprestimos/usp',
        'can' => 'balcão'
    ],
    [
        'text' => '<i class="fas fa-handshake"></i> Empréstimo Visitante',
        'url' => config('app.url') . '/emprestimos/visitante',
        'can' => 'balcão'
    ],
    [
        'text' => '<i class="fas fa-stream"></i> Itens Emprestados',
        'url' => config('app.url') . '/emprestimos',
        'can' => 'balcão'
    ],
    [
        'text' => '<i class="fas fa-chart-bar"></i> Relatório de Empréstimos',
        'url' => config('app.url') . '/emprestimos/relatorio',
        'can' => 'balcão'
    ],
    [
        'text' => '<i class="fas fa-chart-bar"></i> Código de Barras',
        'url' => config('app.url') . '/categorias/barcode',
        'can' => 'balcão'
    ],

];
$menu = [
    [
        'text' => '<i class="fas fa-user-cog"></i> Administração',
        'submenu' => $submenu1,
        'can' => 'balcão',
    ],
    [
        'text' => '<i class="fas fa-retweet"></i> Empréstimos/Devolução',
        'submenu' => $submenu2,
        'can' => 'balcão',
    ],
];

$right_menu = [
    [
        'text' => '<i class="fas fa-cog"></i>',
        'title' => 'Configurações',
        'target' => '_blank',
        'url' => config('app.url') . '/item1',
        'align' => 'right',
        'can' => 'admin',
    ],
];

# dashboard_url renomeado para app_url
# USPTHEME_SKIN deve ser colocado no .env da aplicação 

return [
    'title' => config('app.name'),
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
    'app_url' => config('app.url'),
    'logout_method' => 'POST',
    'logout_url' => config('app.url') . '/logout',
    'login_url' => config('app.url') . '/login',
    'menu' => $menu,
    'right_menu' => $right_menu,
];
