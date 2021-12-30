<?php View::setTitle('Connexion'); ?>

<main>
    <?php View::show('components/header', $params); ?>

    <?php if (isset($params['alert'])) : ?>
        <div id="alert" class="w-1/2 lead fade-in glass <?php echo $params['alert']['type'] ?? 'yellow'; ?> text-gray-less" style="margin: 2rem auto;">
            <?php echo $params['alert']['message'] ?>
        </div>
    <?php endif; ?>

    <section class="hero">
        <section class="p-2 lead" style="margin: auto auto !important;width: 50rem;">
            <div class="desc">
                <h1 class="font-hero slide-in-bottom-h1">Connexion</h1>
                <p class="text-gray-1 slide-in-bottom-subtitle">
                    Créez vos évènements en quelques clics, gérez vos invités, organisez sans inquiétude votre soirée.
                </p>
            </div>
            <form action="<?php echo BASE_PATH . '/signin/auth'; ?>" method="POST">
                <div class="input-group horizontal">
                    <input class="w-full glass text-gray-less" type="email" name="email" id="email" aria-label="Votre adresse e-mail" placeholder="Votre adresse e-mail" required />
                    <input class="w-full glass text-gray-less" type="password" name="password" id="password" aria-label="Votre mot de passe" placeholder="Votre mot de passe" required />
                </div>

                <div class="horizontal justify-start" style="gap: 1rem">
                    <input type="submit" class="btn action slide-in-bottom" value="Se connecter" />
                    <a href="javascript:void(0);" onclick="prompt('Quelle est votre adresse e-mail ?');">Mot de passe oublié?</a>
                </div>
            </form>
        </section>
    </section>

    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>