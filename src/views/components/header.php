<header>
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
            <span class="text-white">$NAME $LASTNAME</span>
            </h1>
        <?php endif; ?>
    </a>
    <nav>
    </nav>
</header>