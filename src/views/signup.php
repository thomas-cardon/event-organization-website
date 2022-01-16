w<?php View::setTitle('Inscription'); ?>

<main>
    <?php View::show('components/header', $params); ?>

    <?php if (isset($params['alert'])) : ?>
        <div id="alert" class="w-1/2 lead fade-in glass <?= $params['alert']['type'] ?? 'yellow'; ?> text-gray-less" style="margin: 2rem auto;">
            <?= $params['alert']['message'] ?>
        </div>
    <?php endif; ?>

    <section class="hero">
        <section class="p-2 lead" style="margin: auto auto !important;width: 50rem;">
            <div class="desc">
                <h1 class="font-hero slide-in-bottom-h1">Inscription</h1>
                <p class="text-gray-1 slide-in-bottom-subtitle">
                    Rejoignez la communauté et découvrez les évènements de votre région.
                </p>
            </div>
            <form action="<?= BASE_PATH . '/signup/post'; ?>" method="POST">
                <div class="input-group">
                    <input class="glass text-gray-less" type="text" name="firstName" id="firstName" aria-label="Votre prénom" placeholder="Votre prénom" required />
                    <input class="glass text-gray-less" type="text" name="lastName" id="lastName" aria-label="Votre nom" placeholder="Votre nom" required />
                </div>

                <div class="input-group horizontal">
                    <input class="w-full glass text-gray-less" type="email" name="email" id="email" aria-label="Votre adresse e-mail" placeholder="Votre adresse e-mail" required />
                </div>

                <div class="horizontal justify-start" style="gap: 1rem">
                    <input type="submit" class="btn action slide-in-bottom" value="S'inscrire" />
                </div>
            </form>
        </section>
    </section>

    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>