<?php 
    View::setTitle('Accueil');
    View::addStyleSheet('/assets/css/recent-events.css');
?>

<main>
    <?php View::show('components/header', $params); ?>

    <section class="hero">
        <section class="p-2 horizontal lead">
            <div id="desc">
                <h1 class="slide-in-bottom-h1">
                        E-Event.IO
                </h1>
                <h6 class="text-gray-1 slide-in-bottom-subtitle">
                    Créez vos évènements en quelques clics, gérez vos invités, organisez sans inquiétude votre soirée.
                </h6>
                <div class="buttons horizontal" style="margin-top: 1rem">
                    <?php if (!$params['authentified']) : ?>
                        <a class="btn action slide-in-bottom" style="margin-top: 1rem">Inscrivez-vous</a>
                        <a class="btn slide-in-bottom" href="<?php echo BASE_PATH ?>/signin" style="margin-top: 1rem">Connectez-vous</a>
                    <?php else : ?>
                        <button class="flex items-center px-4 py-2 text-sm font-medium slide-in-bottom sm text-green-6 green">
                            <svg class="text-green-5" width="12" height="20" fill="currentColor">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"></path>
                            </svg>
                            Nouveau
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <div id="recentEvents" class="fade-in glass text-gray-less">
                <header class="flex items-center justify-between">
                    <div>
                        <h6>Dernières idées d'événements en date</h6>
                        <h7 class="text-gray-4">
                            Campagne du 01/01: <i>Tournoi volleyball</i>
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

                <ul>
                    <li>
                        <a href="<?php echo BASE_PATH; ?>/event/see/1" class="flex items-center text-gray-2">
                            <div class="body">
                                <h6 class="title">
                                    Tournoi volleyball
                                </h6>
                                <h7 class="author">
                                    Jane Doe
                                </h7>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo BASE_PATH; ?>/event/see/1" class="flex items-center text-gray-2">
                            <div class="body">
                                <h6 class="title">
                                    Tournoi volleyball
                                </h6>
                                <h7 class="author">
                                    Jane Doe
                                </h7>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo BASE_PATH; ?>/event/see/1" class="flex items-center text-gray-2">
                            <div class="body">
                                <h6 class="title">
                                    Tournoi volleyball
                                </h6>
                                <h7 class="author">
                                    Jane Doe
                                </h7>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo BASE_PATH; ?>/event/see/1" class="flex items-center text-gray-2">
                            <div class="body">
                                <h6 class="title">
                                    Tournoi volleyball
                                </h6>
                                <h7 class="author">
                                    Jane Doe
                                </h7>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </section>

    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>
