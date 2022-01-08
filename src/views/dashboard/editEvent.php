<?php View::setTitle(($params['edit'] ? 'Editer' : 'Créer') . ' un évènement'); ?>
<section class="dashboard-content">
    <h4 class="font-thin"><?php echo $params['edit'] ? 'Éditer' : 'Créer'; ?> un évènement</h4>
    <form action="<?php echo BASE_PATH . '/dashboard/edit-event'; ?>" method="POST">
        <div class="input-group horizontal">
            <input autofocus type="text" <?php echo $params['event']['canEdit'] ?? true ? '' : 'disabled' ?> aria-label="Nom" placeholder="Nom" value="<?php echo $params['event']['title'] ?? ''; ?>">
            <textarea type="text" <?php echo $params['event']['canEdit'] ?? true ? '' : 'disabled' ?> aria-label="Description" placeholder="Description" rows="5" value="<?php  echo $params['event']['description'] ?? '';?>"></textarea>

            <input type="datetime-local" <?php echo $params['event']['canEdit'] ?? true ? '' : 'disabled' ?> min="<?php echo date('Y-m-d');?>T00:00" aria-label="Date et heure de départ" placeholder="Commence le:" value="<?php echo date('Y-m-d\TH:i', strtotime($params['event']['from'] ?? null)); ?>">
            <input type="datetime-local" <?php echo $params['event']['canEdit'] ?? true ? '' : 'disabled' ?> min="<?php echo date('Y-m-d');?>T00:00" aria-label="Date et heure de fin" placeholder="Termine le:" value="<?php echo date('Y-m-d\TH:i', strtotime($params['event']['to'] ?? null)); ?>">
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