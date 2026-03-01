<?php 

    require_once "classes.php";
    auth_guard();

    $requestedPage = $_GET['page'] ?? 'dashboard';
    $allowedURLPages = array_column($menu, 'urlPage');

    if (!in_array($requestedPage, $allowedURLPages, true)){
        $requestedPage = 'dashboard';
    }

    $menuIndex = array_search($requestedPage, $allowedURLPages);
    $activeMenu = $menu[$menuIndex];
    $folder = $activeMenu['path'];
    $pageTitle = $activeMenu['label'];

    // POST Dispatch 
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $actionName = $_POST['_action'] ?? '';
        $postRoutes = [
            'user.store' => fn() => (new UserController())->store(),
            'user.update' => fn() => (new UserController())->update(),
            'user.delete' => fn() => (new UserController())->destroy(),
        ];

        if (isset($postRoutes[$actionName])){
            $postRoutes[$actionName]();
            exit;
        }
    } 

    // GET Dispatch
    $viewData = [];

    switch ($folder){
        case 'unit':
            $viewData['units'] = '';
            break;
        case 'user':
            $viewData['users'] = (new UserController())->index();
            break;
        case 'product':
            $viewData['products'] = '';
            break;
        case 'customer':
            $viewData['customers'] = '';
            break;
        case 'transaksi':
            $viewData['transactions'] = '';
            break;
        case 'report':
            $viewData['reports'] = '';
            break;
    }

    extract($viewData);

    // Render 
    require "../templates/header.php";
    require "../templates/sidebar.php";
    require "../templates/navbar.php";

    $viewFile = './page/' . $folder . '/index.php';
    if (file_exists($viewFile)){
        require_once $viewFile;
    } else {
        echo '<div class="p-4 text-red-600">Halaman tidak ditemukan</div>';
    }

    require "../templates/footer.php" 
?>