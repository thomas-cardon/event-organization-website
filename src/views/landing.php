<?php View::$title = 'Accueil' ?>

<main class="hero">
    <?php View::show('components/header', $params); ?>
        
    <?php if (isset($params['alert'])) : ?>
        <div id="alert" class="w-1/2 lead fade-in glass <?php echo $params['alert']['type'] ?? 'yellow'; ?> text-gray-less" style="margin: 2rem auto;">
            <?php echo $params['alert']['message'] ?>
        </div>
    <?php endif; ?>

    <section class="p-2 horizontal lead" style="padding-right: 4rem; padding-left: 4rem;">
        <div class="w-1/2 lead">
            <h1 class="font-hero slide-in-bottom-h1">
                	E-Event.IO
            </h1>
            <h6 class="text-gray-1 slide-in-bottom-subtitle">
                Créez vos évènements en quelques clics, gérez vos invités, organisez sans inquiétude votre soirée.
            </h6>
            <div class="button-group" style="margin-top: 1rem">
                <?php if (!$params['authentified']) : ?>
                    <button class="action slide-in-bottom" style="margin-top: 1rem">Inscrivez-vous</button>
                    <button class="slide-in-bottom" style="margin-top: 1rem">Connectez-vous</button>
                <?php else : ?>
                    <button class="flex items-center px-4 py-2 text-sm font-medium sm text-green-6 green">
                        <svg class="text-green-5" width="12" height="20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"></path>
                        </svg>
                        Nouveau
                    </button>
                <?php endif; ?>
            </div>
        </div>
        <div id="recentEvents" class="w-1/2 lead fade-in events-list text-gray-less">
            <header class="flex items-center justify-between">
                <div>
                    <h6>Derniers événements en date</h6>
                    <h7 class="text-gray-4">
                        Campagne du 01/01: <i>Tournoi voleyball</i>
                    </h7>
                </div>
                <?php if ($params['authentified']) : ?>
                    <button class="flex items-center px-4 py-2 text-sm font-medium sm text-green-6 green">
                        <svg class="text-green-5" width="12" height="20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"></path>
                        </svg>
                        Nouveau
                    </button>
                <?php endif; ?>
            </header>
            <!-- 
                <input class="w-full green search text-gray-less" type="text" aria-label="Filtrer les idées d'évènements" placeholder="Filtrer les idées d'évènements" />
            -->
        </div>
    </section>
    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>