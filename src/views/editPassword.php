<?php View::setTitle('page de modification de mot de passe'); ?>

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
                <h4 class="text-gray-1 slide-in-bottom-subtitle">
                    Définissez votre nouveau mot de passe
                </h4>
            </div>
            <form action="<?= BASE_PATH . '/editPasswordAction'; ?>" method="POST">
                <div class="input">
                    <input class="w-full glass text-gray-less" type="password" name="password1" id="password" aria-label="Votre mot de passe" placeholder="Votre mot de passe" required />
                    <input class="w-full glass text-gray-less" type="password" name="password2" id="passwordverif" aria-label="Confirmez votre mot de passe" placeholder="Confirmez votre mot de passe" required/>
                </div>

                <div class="horizontal justify-start" style="gap: 1rem">
                    <input type="submit" class="btn action slide-in-bottom" value="Validé"
                </div>
            </form>
        </section>
    </section>

    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>