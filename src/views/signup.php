<?php View::setTitle('Inscription'); ?>

<main class="lead">
    <?php View::show('components/header'); ?>

    <section class="p-2">
        <h1 class="slide-in-bottom-h1">Inscription</h1>
        <h6 class="text-gray-1 slide-in-bottom-subtitle subtitle">
            Rejoignez la communauté et découvrez les évènements de votre région.
        </h6>
        
        <form action="<?php echo BASE_PATH . '/signup'; ?>" method="POST">
            <div class="input-group horizontal">
                <input class="w-full glass text-gray-less" type="text" aria-label="Votre nom" placeholder="Votre nom" />
                <input class="w-full glass text-gray-less" type="text" aria-label="Votre prénom" placeholder="Votre prénom" />
            </div>
            <input class="w-full glass text-gray-less" type="text" aria-label="Votre adresse-mail" placeholder="Votre adresse-mail" />

            <input type="submit" class="action slide-in-bottom" style="margin-top: 1rem" value="Créer" />
        </form>
    </section>
    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>