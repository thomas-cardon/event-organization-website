<?php View::setTitle(($params['edit'] ? 'Editer' : 'Créer') . ' un évènement'); ?>
<section class="dashboard-content">
    <h4 class="font-thin"><?= $params['edit'] ? 'Éditer' : 'Créer'; ?> un évènement</h4>
    <form action="<?= BASE_PATH . '/dashboard/' . ($params['edit'] ? 'edit-' : 'create-') . 'event'; ?>" method="POST">
        <div class="input-group horizontal">
            <input autofocus type="text" name="Nom" id="Nom" aria-label="Nom" placeholder="Nom" required>
            <textarea type="text" name="Description" id="Description" aria-label="Description" placeholder="Description" rows="5"></textarea>

            <input type="datetime-local" name="DateDep" id="DateDep" min="<?= date('Y-m-d');?>T00:00" aria-label="DateDep" placeholder="Commence le:" value="<?= date('Y-m-d\TH:i', strtotime($params['event']['from'] ?? null)); ?>">
            <input type="datetime-local" name="DateFin" id="DateFin" min="<?= date('Y-m-d');?>T00:00" aria-label="DateFin" placeholder="DateFin" value="<?= date('Y-m-d\TH:i', strtotime($params['event']['to'] ?? null)); ?>">
            <p style="margin: 1rem 0; text-align: justify; font-size: large">
                <i>
                    <?php if ($params['edit']): ?>
                        Certains champs ne sont pas modifiables une fois qu'un donateur dépense des points pour cet évènements.
                    <?php else: ?>
                        Vous pourrez créer des contenus débloquables dès la publication de votre évènement en retournant sur votre tableau de bord.
                    <?php endif; ?>
                    Pour que votre contenu soit visible par le jury, il vous faudra atteindre <?= EVENT_MIN_POINTS_REQUIRED; ?> points.
                </i>
            </p>

            <input type="submit" value="Créer">
        </div>
    </form>
</section>