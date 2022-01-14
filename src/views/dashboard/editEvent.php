<?php View::setTitle(($params['edit'] ? 'Editer' : 'Créer') . ' un évènement'); ?>
<section class="dashboard-content">
    <h4 class="font-thin"><?= $params['edit'] ? 'Éditer' : 'Créer'; ?> un évènement</h4>
    <form action="<?= BASE_PATH . '/Dashboard/CreateEvent'; ?>" method="POST">
        <div class="input-group horizontal">
            <input autofocus type="text" name="Nom" id="Nom" aria-label="Nom" placeholder="Nom" required>
            <textarea type="text" name="Description" id="Description" aria-label="Description" placeholder="Description" rows="5"></textarea>

            <input type="datetime-local"  name="Date et heure de départ" id="Date et heure de départ" aria-label="Date et heure de départ" placeholder="Commence le:" required>
            <input type="datetime-local"  name="Date et heure de fin" id="Date et heure de fin" aria-label="Date et heure de fin" placeholder="Termine le:" required>
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