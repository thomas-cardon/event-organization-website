<?php View::setTitle('Connexion'); ?>

<main>
    <?php View::show('components/header', $params); ?>

    <?php if (isset($params['alert'])) : ?>
        <div id="alert" class="w-1/2 lead fade-in glass <?php echo $params['alert']['type'] ?? 'yellow'; ?> text-gray-less" style="margin: 2rem auto;">
            <?php echo $params['alert']['message'] ?>
        </div>
    <?php endif; ?>

    <section class="hero">
        <section class="p-2" style="margin: auto auto !important;width: 50rem;">
            <h1 class="font-hero slide-in-bottom-h1">Connexion</h1>
            <h6 class="text-gray-1 slide-in-bottom-subtitle subtitle">
                Connectez-vous pour accéder à votre espace personnel et gérer vos évènements.
            </h6>            
            <form action="<?php echo BASE_PATH . '/signin/auth'; ?>" method="POST">
                <div class="input-group horizontal">
                    <input class="w-full glass text-gray-less" type="text" aria-label="Votre nom" placeholder="Votre nom" />
                    <input class="w-full glass text-gray-less" type="text" aria-label="Votre prénom" placeholder="Votre prénom" />
                </div>
                <input class="w-full glass text-gray-less" type="text" aria-label="Votre adresse-mail" placeholder="Votre adresse-mail" />

                <input type="submit" class="action slide-in-bottom" style="margin-top: 1rem; margin-right: 1rem;" value="Créer" />
                <a>Mot de passe oublié?</a>
            </form>
        </section>
    </section>

    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>