<script>
    function openNavbarMenu() {
        var x = document.getElementById('layout');
        if (x.className === '') x.className = 'responsive';
        else x.className = '';
    }
</script>
<header id="layout">
    <a class="flex items-center horizontal text-indigo-4 brand" href="<?php echo BASE_PATH; ?>">
		<svg class="text-indigo-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
			<path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z" />
		</svg>
        <h3 class="font-hero">
            E-Event.IO&nbsp;
            <?php if ($params['authentified'] ?? false) : ?>
            <span class="text-white">|</span>
            <?php endif; ?>
        </h3>
    </a>
        <?php if ($params['authentified'] ?? false) : ?>
        <div class="text-white font-hero flex m" style="margin-left: 1rem">
            <span><?php echo $params['user']->getName(); ?></span>
            <div class="horizontal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.667 13.984c1.782 0 3.333-.671 3.333-1.5s-1.552-1.5-3.333-1.5c-1.781 0-3.333.671-3.333 1.5s1.551 1.5 3.333 1.5zm.062-1.339c-.199-.06-.81-.111-.81-.45 0-.189.223-.358.639-.396v-.148h.214v.141c.156.004.33.021.523.06l-.078.229c-.147-.034-.311-.066-.472-.066l-.048.001c-.321.013-.347.191-.125.267.364.112.844.195.844.493 0 .238-.289.366-.645.397v.146h-.214v-.139c-.22-.002-.451-.038-.642-.102l.098-.229c.163.042.367.084.552.084l.139-.01c.247-.034.296-.2.025-.278zm-.062 5.339c1.261 0 2.57-.323 3.333-.934v.434c0 .829-1.552 1.516-3.333 1.516-1.781 0-3.333-.687-3.333-1.516v-.434c.763.612 2.071.934 3.333.934zm0-3.333c1.261 0 2.57-.323 3.333-.934v.434c0 .829-1.552 1.5-3.333 1.5-1.781 0-3.333-.671-3.333-1.5v-.434c.763.611 2.071.934 3.333.934zm0 1.667c1.261 0 2.57-.323 3.333-.935v.435c0 .828-1.552 1.5-3.333 1.5-1.781 0-3.333-.672-3.333-1.5v-.435c.763.612 2.071.935 3.333.935zm-8.441-3.089c0 .601-.47.922-1.05 1.002v.369h-.351v-.35c-.362-.006-.737-.092-1.05-.254l.16-.575c.334.129.78.267 1.128.189.402-.091.485-.505.041-.705-.326-.15-1.323-.281-1.323-1.134 0-.477.363-.904 1.044-.998v-.373h.351v.356c.253.006.538.051.855.147l-.127.576c-.269-.094-.566-.18-.855-.162-.521.031-.567.482-.204.671.599.282 1.381.491 1.381 1.241zm5.774-7.229h-17v10h-1v-11h18v1zm-16 1v11h14v-5.516c0-1.792 1.985-2.71 4-2.875v-2.609h-18zm9 9c-1.933 0-3.5-1.567-3.5-3.5s1.567-3.5 3.5-3.5 3.5 1.567 3.5 3.5-1.567 3.5-3.5 3.5z"/></svg>
                <span><?php echo $params['user']->getPoints(); ?></span>
            </div>
        </div>
        <?php endif; ?> 
    <nav>
        <?php            
            $links = array(
                array( 'url' => '/', 'label' => 'Accueil' ),
                array( 'url' => '/dashboard', 'label' => 'Tableau de bord' ),
                array( 'url' => '/event/winners', 'label' => 'Grands gagnants' ),
                array( 'url' => '/signin/logout', 'label' => 'Déconnexion', 'authRequired' => true ),
            );

            foreach ($links as $link) {
                $class = '';
                
                if (isset($link['url']) && BASE_PATH . $link['url'] === $_SERVER['REQUEST_URI']) {
                    $class .= ' active';
                }

                if (isset($link['authRequired']) && $link['authRequired'] && !$params['authentified']) {
                    continue;
                }
                
                echo '<a class="' . $class . '" href="' . BASE_PATH . $link['url'] . '">' . $link['label'] . '</a>';
            }
        ?>
        <a class="text-gray-1 close" href="javascript:void(0);" onclick="openNavbarMenu()">☰</a>
    </nav>
</header>
<?php if (isset($params['alert'])) : ?>
    <div id="alert" class="w-1/2 lead fade-in glass <?php echo $params['alert']['type'] ?? 'yellow'; ?> text-gray-less" style="margin: 2rem auto !important;">
        <?php echo $params['alert']['message'] ?>
    </div>
<?php endif; ?>