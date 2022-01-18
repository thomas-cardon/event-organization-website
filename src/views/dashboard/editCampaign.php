<section class="dashboard-content">
    <h4 class="font-thin"><?= $params['edit'] ? 'Éditer' : 'Créer'; ?> une campagne</h4>
    <form action="<?= BASE_PATH . '/dashboard/' . ($params['edit'] ? 'edit-' : 'create-') . 'campaign'; ?>" method="POST">
        <div class="input-group horizontal">
            <input autofocus type="text" class="text-white" name="Nom" aria-label="Nom" placeholder="Nom">
            <textarea type="text" class="text-white" name="Description" aria-label="Description" placeholder="Description" rows="5"></textarea>

            <input type="datetime-local" class="text-white" min="<?= date('Y-m-d');?>T00:00" name="datedep" aria-label="Date et heure de départ" placeholder="Commence le:">
            <input type="datetime-local" class="text-white" min="<?= date('Y-m-d');?>T00:00" name="datefin" aria-label="Date et heure de fin" placeholder="Termine le:">
            <p style="margin: 1rem 0; text-align: justify; font-size: large">
                <i>
                    Pendant la période de la campagne, les organisateurs pourront ajouter des évènements.
                    Après la fin de la campagne, les évènements devront être validés par le jury.
                    Toute les idées, réalisées ou non, resteront visibles pour tout le monde.
                </i>
            </p>

            <input type="submit" value="Créer">
        </div>
    </form>
</section>