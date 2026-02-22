<aside class="bg-gray-800 w-40 text-white">
    <div class="p-2 text-xl font-bold border-b border-gray-700">
        Mini Aplikasi
    </div>
    <nav>
        <?php foreach($menu as $val){ ?>
            <a <?= $val['isNewTab'] ? 'target="_blank"':'' ?> href="?page=<?= $val['urlPage'] ?>" class="block p-2 <?= $page === $val['urlPage'] ? 'bg-gray-400 hover:bg-gray-500':'hover:bg-gray-700' ?>"><?= $val['label'] ?></a>
        <?php } ?>
    </nav>
</aside>