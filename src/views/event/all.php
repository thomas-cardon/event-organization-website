<?php 
    View::setTitle('Idées d\'événement');
?>

<section class="lead">
    <h1 class="font-hero slide-in-bottom-h1">Idées d'évènements</h1>
    <p>Validées ou non par le jury</p>

    <div class="glass fade-in" style="margin-top: 2rem">
        <table class="w-full">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($params['events'] as $event) { ?>
                <tr>
                    <td><?= $event->getName(); ?></td>
                    <td class="xs"><?= $event->getDescription(); ?></td>
                    <td><?= $event->getStartDate()->format('d/m'); ?></td>
                    <td><?= $event->getEndDate()->format('d/m'); ?></td>
                    <td>
                        <a href="<?= BASE_PATH . '/event/see/' . $event->getId(); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>