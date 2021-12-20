<header id="layout">
    <a class="flex items-center text-indigo-4 brand" href="<?php echo BASE_PATH; ?>">
		<svg class="text-indigo-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
			<path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z" />
		</svg>
        <?php if (!$params['authentified']) : ?>
            <h1 style="font-family: 'BigNoodleTitling Oblique'">
            E-Event.IO
            </h1>
        <?php else : ?>
            <h1 style="font-family: 'BigNoodleTitling Oblique'">
                E-Event.IO&nbsp;
                <span class="text-white">|</span>
                <span class="text-white"><?php echo $params['user']['firstName'] . ' ' . $params['user']['lastName']; ?></span>
            </h1>
        <?php endif; ?>
    </a>
    <nav>
        <a class="text-gray-1" href="<?php echo BASE_PATH; ?>">Créer</a>
        <a class="text-gray-1 active" href="<?php echo BASE_PATH; ?>">Mes évènements</a>
        <a class="text-gray-1" href="<?php echo BASE_PATH; ?>">Mes invitations</a>
        <a class="text-gray-1" href="<?php echo BASE_PATH; ?>">Contact</a>
        <a class="text-gray-1" href="<?php echo BASE_PATH; ?>">Profil</a>

        <a class="text-gray-1 close" href="javascript:void(0);" onclick="openNavbarMenu()">☰</a>
    </nav>
</header>
<script>
    function openNavbarMenu() {
        var x = document.getElementById('layout');
        if (x.className === '') x.className = 'responsive';
        else x.className = '';
    }
</script>