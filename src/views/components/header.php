<header id="layout">
    <a class="flex items-center text-indigo-4 brand" href="<?php echo BASE_PATH; ?>">
		<svg class="text-indigo-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
			<path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z" />
		</svg>
        <h1 style="font-family: 'BigNoodleTitling Oblique'">
            E-Event.IO&nbsp;
            <?php if ($params['authentified'] ?? false) : ?>
            <span class="text-white">|</span>
            <span class="text-white"><?php echo $params['user']['firstName'] . ' ' . $params['user']['lastName']; ?></span>
            <?php endif; ?>
        </h1>
    </a>
    <nav>
        <a class="text-gray-1 active" href="<?php echo BASE_PATH; ?>">Accueil</a>
        <?php if ($params['authentified'] ?? false) : ?>
            <a class="text-gray-1" href="<?php echo BASE_PATH . '/events/create'; ?>">Créer</a>

            <a class="text-gray-1" href="<?php echo BASE_PATH . '/dashboard/my-events'; ?>">Mes évènements</a>
            <a class="text-gray-1" href="<?php echo BASE_PATH; ?>">Mes invitations</a>
            <a class="text-gray-1" href="<?php echo BASE_PATH . '/dashboard/profile'; ?>">Profil</a>
        <?php endif; ?>
            <a class="text-gray-1" href="<?php echo BASE_PATH . '/about'; ?>">A propos</a>
            <a class="text-gray-1" href="<?php echo BASE_PATH . '/contact-us'; ?>">Contact</a>

        <a class="text-gray-1 close" href="javascript:void(0);" onclick="openNavbarMenu()">☰</a>
    </nav>
</header>
<?php if (isset($params['alert'])) : ?>
    <div id="alert" class="w-1/2 lead fade-in glass <?php echo $params['alert']['type'] ?? 'yellow'; ?> text-gray-less" style="margin: 2rem auto !important;">
        <?php echo $params['alert']['message'] ?>
    </div>
<?php endif; ?>
<script>
    function openNavbarMenu() {
        var x = document.getElementById('layout');
        if (x.className === '') x.className = 'responsive';
        else x.className = '';
    }
</script>