<?php View::setTitle('Inscription'); ?>

<main class="lead">
    <?php View::show('components/header', $params); ?>

    <?php if (isset($params['alert'])) : ?>
        <div id="alert" class="w-1/2 lead fade-in glass <?php echo $params['alert']['type'] ?? 'yellow'; ?> text-gray-less" style="margin: 2rem auto;">
            <?php echo $params['alert']['message'] ?>
        </div>
    <?php endif; ?>

    <section class="p-2">
        <h1 class="slide-in-bottom-h1">Inscription</h1>
        <h6 class="text-gray-1 slide-in-bottom-subtitle subtitle">
            Rejoignez la communauté et découvrez les évènements de votre région.
        </h6>
        
        <form action="<?php echo BASE_PATH . '/signup'; ?>" method="POST">
            <div class="input-group horizontal">
                <input class="w-full glass text-gray-less" type="text" name="nom" id="nom" aria-label="Votre nom" placeholder="Votre nom" required />
                <input class="w-full glass text-gray-less" type="text" name="prenom" id="prenom" aria-label="Votre prénom" placeholder="Votre prenom" required />
                <input class="w-full glass text-gray-less" type="email" name="email" id="email" aria-label="Votre adresse e-mail" placeholder="Votre adresse e-mail" required />
            </div>
            <input type="submit" class="action slide-in-bottom" style="margin-top: 1rem" value="Créer" />
        </form>
    </section>
    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>