<?php View::$title = 'Accueil' ?>

<main class="hero">
    <?php View::show('components/header'); ?>

    <section class="p-2 horizontal lead" style="padding-right: 4rem; padding-left: 4rem;">
        <div class="w-1/2 lead">
            <h1 class="font-hero slide-in-bottom-h1">
                	E-Event.IO
            </h1>
            <h6 class="text-gray-1 slide-in-bottom-subtitle">
                Créez vos évènements en quelques clics, gérez vos invités, organisez sans inquiétude votre soirée.
            </h6>
            <button class="slide-in-bottom" style="margin-top: 1rem">Inscrivez-vous</button>
        </div>
        <div id="recentEvents" class="w-1/2 lead fade-in events-list text-gray-less">
            <header class="flex items-center justify-between">
                <h6>Derniers événements</h6>
                <button class="flex items-center px-4 py-2 text-sm font-medium sm text-green-6 green">
                    <svg class="text-green-5" width="12" height="20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"></path>
                    </svg>
                    Nouveau
                </button>
            </header>
            <input class="w-full green search text-gray-less" type="text" aria-label="Filtrer les idées d'évènements" placeholder="Filtrer les idées d'évènements" />
        </div>
    </section>
    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>