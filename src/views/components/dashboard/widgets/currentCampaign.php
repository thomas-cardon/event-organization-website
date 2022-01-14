<?php
    if ($params['data'] === null)
        return;
?>
<div class="flex card" style="margin-top: 2rem;">

    <header class="horizontal">
        <h4 class="font-thin">
            Campagne | <b><?= $params['data']->getName() ?></b>
        </h4>
        <p class="s">
            <i>
                <?= $params['data']->getDescription() ?>
            </i>
        </p>
    </header>

    <ul style="display: flex; flex-direction: column; gap: 20px; margin-left: 1rem;">
        <li>
            Cette campagne a été créée le <?= $params['data']->getCreatedAt()->format('d F Y') ?>
            <br />
            et a été modifiée pour la dernière fois le <?= $params['data']->getUpdatedAt()->format('d F Y') ?>.
        </li>
        <li>
            Elle a commencé le <?= date('d F Y', $params['data']->getFrom()) ?>
            <br />
            et se terminera le <?= date('d F Y', $params['data']->getTo()) ?>.
        </li>
        <li>
            Elle a commencé le <?= date('d F Y', $params['data']->getFrom()) ?>
            <br />
            et se terminera le <?= date('d F Y', $params['data']->getTo()) ?>.
        </li>
        <li>
            Il y a actuellement <?= count($params['events']) ?> évènements dans cette campagne.
        </li>
    </ul>
</div>