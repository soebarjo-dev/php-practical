<?php 

    require_once "classes.php";
    auth_guard();

    $requestedPage = $_GET['page'] ?? 'dashboard';
    if ($requestedPage === 'sign-out'){
        (new AuthController())->signOut();
    }

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
            'unit.store' => fn() => (new UnitController())->store(),
            'unit.update' => fn() => (new UnitController())->update(),
            'unit.delete' => fn() => (new UnitController())->destroy(),
            'customer.store' => fn() => (new CustomerController())->store(),
            'customer.update' => fn() => (new CustomerController())->update(),
            'customer.delete' => fn() => (new CustomerController())->destroy(),
            'product.store' => fn() => (new ProductController())->store(),
            'product.update' => fn() => (new ProductController())->update(),
            'product.delete' => fn() => (new ProductController())->destroy(),
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
            $viewData['units'] = (new UnitController())->index();
            break;
        case 'user':
            $viewData['users'] = (new UserController())->index();
            break;
        case 'product':
            $viewData['products'] = (new ProductController())->index();
            $viewData['list_units'] = (new ProductController())->lists('units');
            break;
        case 'customer':
            $viewData['customers'] = (new CustomerController())->index();
            break;
        case 'transaksi':
            if (isset($_GET['detail'])){
                
            } else {
                $viewData['transactions'] = '';
                $viewData['customers'] = (new TransactionController())->lists('customers');
                $viewData['products'] = (new TransactionController())->lists('products');
            }
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
        $flashSuccess = $_SESSION['flash_success'] ?? null;
        $flashError = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_success'], $_SESSION['flash_error']);

        require_once $viewFile;
    } else {
        echo '<div class="p-4 text-red-600">Halaman tidak ditemukan</div>';
    }

    require "../templates/footer.php" 
?>