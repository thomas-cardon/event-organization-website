<section class="dashboard-content">
    <h4 class="font-thin">Ajouter des points</h4>
    <form action="<?= BASE_PATH; ?>/dashboard/add-points/<?= $params['target']->getId() ?>" method="POST">
        <div class="flex items-center">
            <div class="avatar-container">
                <img class="avatar" onerror="this.src='<?= Constants::getPublicPath() . '/vendor/svg/placeholder-bg.svg'; ?>'" src="<?= $params['target']->getAvatar(); ?>" alt="Avatar de <?= $params['target']->getName(); ?>">
            </div>
            <h2 class="font-hero">
                <?= $params['target']->getName(); ?>
            </h2>
            <p class="m text-gray-1">
                <?= $params['target']->getEmail(); ?>
            </p>

            <input style="margin-top: 1.5rem;" type="number" id="amount" name="amount" aria-label="Montant" placeholder="Montant" required>
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