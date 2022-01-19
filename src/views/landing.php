<?php 
    View::setTitle('Accueil');
    View::addStyleSheet('/assets/css/recent-events.css');
?>

<main>
    <?php View::show('components/header', $params); ?>

    <section class="hero">
        <section class="p-2 horizontal lead">
            <div id="desc">
                <h1 class="font-hero slide-in-bottom-h1">
                        E-Event.IO
                </h1>
                <p class="text-gray-1 slide-in-bottom-subtitle">
                    Créez vos évènements en quelques clics, gérez vos invités, organisez avec quiétude votre soirée.
                </p>
                <?php if (!$params['authentified']) : ?>
                    <div class="buttons horizontal" style="margin-top: 1rem">
                            <a class="btn action slide-in-bottom" href="<?= BASE_PATH ?>/signup" style="margin-top: 1rem" style="margin-top: 1rem">Inscrivez-vous</a>
                            <a class="btn slide-in-bottom" href="<?= BASE_PATH ?>/signin" style="margin-top: 1rem">Connectez-vous</a>
                    </div>
                <?php elseif ($params['user']->getRole() === 'organizer' || $params['user']->getRole() === 'admin'): ?>
                    <a href="<?= BASE_PATH; ?>/dashboard/create-event" style="margin-top: 1rem; width: 12rem;" class="btn horizontal text-sm font-medium slide-in-bottom text-green-6 green">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-green-5" fill="currentColor" width="50" height="50" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg>
                        Nouveau
                    </a>
                <?php endif; ?>
            </div>
            <?php
            if (isset($params['current_campaign'])): ?>
                <div id="recentEvents" class="fade-in glass text-gray-less">
                    <header class="flex items-center justify-between">
                        <div>
                            <h3 class="font-hero">Dernières idées d'événements en date</h3>
                            <p class="text-gray-3">
                                Campagne du <?= $params['current_campaign']->getStartDate()->format('d/m') ?>
                                au <?= $params['current_campaign']->getEndDate()->format('d/m') ?>:
                                <i>
                                    <?= $params['current_campaign']->getName() ?>
                                </i>
                            </p>
                        </div>
                    </header>

                    <ul>
                        <?php foreach ($params['events'] as $event): ?>
                        <li>
                            <a href="<?= BASE_PATH; ?>/event/see/<?= $event->getId(); ?>" class="flex items-center text-gray-2">
                                <div class="body">
                                    <h4 class="font-hero">
                                        <?= $event->getName() ?>
                                    </h4>
                                    <p class="text-gray-2">
                                        <?= $event->getAuthor()->getName() ?>
                                    </p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <center>
                        <a href="<?= BASE_PATH; ?>/event/all">
                            Voir tous les événements
                        </a>
                    </center>
                </div>
            <?php endif; ?>
        </section>
    </section>

    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>
