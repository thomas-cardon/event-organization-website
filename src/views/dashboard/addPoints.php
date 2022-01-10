<section class="dashboard-content">
    <h4 class="font-thin">Ajouter des points</h4>
    <form action="/dashboard/add-points/<?= $params['target']->getId() ?>" method="POST">
        <div class="flex items-center">
            <div class="avatar-container">
                <img class="avatar" onerror="this.src='<?php echo Constants::getPublicPath() . '/vendor/svg/placeholder-bg.svg'; ?>'" src="<?php echo $params['target']->getAvatar(); ?>" alt="Avatar de <?php echo $params['target']->getName(); ?>">
            </div>
            <h2 class="font-hero">
                <?php echo $params['target']->getName(); ?>
            </h2>
            <p class="m text-gray-1">
                <?php echo $params['target']->getEmail(); ?>
            </p>

            <input style="margin-top: 1.5rem;" type="number" aria-label="Montant" placeholder="Montant">
        </div>
        
        <p style="margin-top: 1.5rem; text-align: justify; font-size: large">
            <i>
                Si vous insérez une valeur négative, le montant indiqué sera retiré à l'utilisateur.
            </i>
        </p>

        <div class="actions">
            <input type="submit" value="Exécuter">
        </div>
    </form>
</section>