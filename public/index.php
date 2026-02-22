<?php 
    require_once "../config/General.php";
    require "../templates/header.php";
    require "../templates/sidebar.php";
    require "../templates/navbar.php";
    
    if ($page !== 'unknown'){
        $menuByURLPage = array_column($menu, "urlPage");
        $indexMenuURLPage = array_search($page, $menuByURLPage);
        
        if (isset($menu[$indexMenuURLPage])){
            $folder = $menu[$indexMenuURLPage]['path'];
            require_once './page/' . $folder . '/index.php';
        } else {
            echo "error";
        }
    } else {
        echo "dashboard";
    }

    require "../templates/footer.php" 
?>