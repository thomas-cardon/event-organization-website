<section class="dashboard-content">
    <h4 class="font-thin">Mon compte</h4>
    
    <form action="" method="POST">

        <div class="avatar-container" style="margin-bottom: 2rem;">
            <img class="avatar hover-pointer" onclick="alert('Pour changer votre avatar, rendez-vous sur le site Gravatar');" onerror="this.src='<?= Constants::getPublicPath() . '/vendor/svg/placeholder-bg.svg'; ?>'" src="<?= $params['user']->getAvatar(); ?>" alt="Avatar de <?= $params['user']->getName(); ?>">
        </div>
        
        <div class="input-group horizontal" style="margin-bottom: 1rem;">
            <input disabled autofocus class="w-full" type="text" aria-label="Nom" placeholder="Nom" name="nom" <?php if (isset($params['user'])): ?> value="<?= $params['user']->getLastName(); ?>" <?php endif; ?>>
            <input disabled class="w-full" type="text" aria-label="Prénom" placeholder="Prénom" name="prenom" <?php if (isset($params['user'])): ?> value="<?= $params['user']->getFirstName(); ?>" <?php endif; ?>>
            <input disabled class="w-full" type="text" aria-label="Adresse e-mail" placeholder="Adresse e-mail" name="email" <?php if (isset($params['user'])): ?> value="<?= $params['user']->getEmail(); ?>" <?php endif; ?>>
        </div>

        <div class="input-group horizontal" style="margin-bottom: 1rem;">
            <input autofocus class="w-full" type="password" aria-label="Mot de passe" placeholder="Mot de passe" disabled>
            <input autofocus class="w-full" type="password" aria-label="Confirmation" placeholder="Confirmation mot de passe" disabled>
            <p>
                Pour changer de mot de passe, déconnectez-vous et faites "mot de passe oublié".
            </p>
        </div>
    </form>
</section>