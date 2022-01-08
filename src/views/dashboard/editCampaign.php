<?php View::setTitle(($params['edit'] ? 'Editer' : 'Créer') . ' une campagne'); ?>
<section class="dashboard-content">
    <h4 class="font-thin"><?php echo $params['edit'] ? 'Éditer' : 'Créer'; ?> une campagne</h4>
    <form action="<?php echo BASE_PATH . '/dashboard/edit-campaign'; ?>" method="POST">
        <div class="input-group horizontal">
            <input autofocus type="text" class="text-white" aria-label="Nom" placeholder="Nom">
            <textarea type="text" class="text-white" aria-label="Description" placeholder="Description" rows="5"></textarea>

            <input type="datetime-local" class="text-white" min="<?php echo date('Y-m-d');?>T00:00" aria-label="Date et heure de départ" placeholder="Commence le:">
            <input type="datetime-local" class="text-white" min="<?php echo date('Y-m-d');?>T00:00" aria-label="Date et heure de fin" placeholder="Termine le:">
            <p style="margin: 1rem 0; text-align: justify; font-size: large">
                <i>
                    q
                </i>
            </p>

            <input type="submit" value="Créer">
        </div>
    </form>
</section>