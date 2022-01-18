<?php if (!isset($params['campaign'])): ?>
<section class="dashboard-content">
    <h1 class="font-thin">Vous ne pouvez pas encore voter</h1>
    <p>Vous devez attendre la fin de la campagne pour pouvoir voter.</p>
</section>
<?php else: ?>
<section class="dashboard-content">
    <h1 class="font-thin">Voter</h1>
    <p class="subtitle">
        Votez pour les évènements qui vous intéressent.
        <br />
        Les évènements sont triés par popularité (points).
    </p>

    <div style="margin-top: 1rem;"></div>

    <h3 class="font-hero"><?= $params['campaign']->getName(); ?></h3>
    <p class="s italic"><?= $params['campaign']->getDescription(); ?></p>
    <hr />

    <div class="vote-deck">
        <?php foreach ($params['campaign_events'] as $event): ?>
            <div class="vote-card">
                <div class="vote-card-header">
                    <h5 class="font-thin">
                        <?= $event->getName(); ?>
                    </h5>
                    <p>
                        <span class="font-thin">Date:</span>
                        <span class="s">
                            <?= $params['campaign']->getStartDate()->format('d/m/Y'); ?>
                        </span>
                        <span class="font-thin">Auteur:</span>
                        <span class="s">
                            <?= $event->getAuthor()->getName(); ?>
                        </span>
                        <span class="font-thin">Popularité:</span>
                        <span class="s">
                            <?= $event->getPointsAmount(); ?>
                        </span>
                        <a class="s" href="<?= BASE_PATH . '/dashboard/event/see/' . $event->getId(); ?>">
                            Voir
                        </a>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>