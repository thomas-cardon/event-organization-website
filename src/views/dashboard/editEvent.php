<?php View::setTitle(($params['edit'] ? 'Editer' : 'Créer') . ' un évènement'); ?>
<section class="dashboard-content">
    <h1><?php echo $params['edit'] ? 'Éditer' : 'Créer'; ?> un évènement</h1>
    <form action="<?php echo BASE_PATH . '/dashboard/edit-event'; ?>" method="POST">
        <div class="input-group horizontal">
            <input type="text" class="text-white" aria-label="Nom" placeholder="Nom">
            <textarea type="text" class="text-white" aria-label="Description" placeholder="Description" rows="5"></textarea>

            <input type="datetime-local" class="text-white" min="<?php echo date('Y-m-d');?>T00:00" aria-label="Date et heure de départ" placeholder="Commence le:">
            <input type="datetime-local" class="text-white" min="<?php echo date('Y-m-d');?>T00:00" aria-label="Date et heure de fin" placeholder="Termine le:">
            <p style="margin: 1rem 0; text-align: justify; font-size: large">
                <i>
                    <?php if ($params['edit']): ?>
                        Certains champs ne sont pas modifiables une fois qu'un donateur dépense des points pour cet évènements.
                    <?php else: ?>
                        Vous pourrez créer des contenus débloquables dès la publication de votre évènement en retournant sur votre tableau de bord.
                    <?php endif; ?>
                    Pour que votre contenu soit visible par le jury, il vous faudra atteindre <?php echo EVENT_MIN_POINTS_REQUIRED; ?> points.
                </i>
            </p>

            <input type="submit" value="Créer">
        </div>
    </form>
</section>