<?php 
    $i = count($params['unlockableContent'] ?? []) - 1;
    $onsubmit = "console.log('submitting..');document.getElementById('unlockableContent" . $i . "').remove(); return true;";
    View::addScript('editEvent', '/assets/js/editEvent.js', '', '', true, 'text/javascript', 'head');
?>
<section class="dashboard-content">
    <h4 class="font-thin"><?= $params['edit'] ? 'Éditer' : 'Créer'; ?> un évènement</h4>
    <form id="editEventForm" action="<?= BASE_PATH . '/dashboard/' . ($params['edit'] ? 'edit-' : 'create-') . 'event'; ?>" method="POST" onsubmit="return submit();">
        <div class="input-group horizontal">
            <input autofocus type="text" name="Nom" id="Nom" aria-label="Nom" placeholder="Nom" required value="<?= $params['edit'] ? $params['event']->getName() : ''; ?>">
            <textarea type="text" name="Description" id="Description" aria-label="Description" placeholder="Description" rows="5"></textarea>
            <input type="datetime-local" name="DateDep" id="DateDep" min="<?= date('Y-m-d\TH:i');?>" aria-label="DateDep" placeholder="Commence le:">
            <input type="datetime-local" name="DateFin" id="DateFin" min="<?= date('Y-m-d\TH:i');?>" aria-label="DateFin" placeholder="Termine le:">

            <div class="glass green text-gray-less" style="margin: 2rem 0;">
                <header class="flex items-center justify-between">
                    <div class="horizontal space-between w-full">
                        <h3 class="font-hero">Contenus additionnels</h3>
                        <a class="btn sm" href="javascript:void(0);" onclick="newUnlockableContent()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-5" fill="currentColor" width="1rem" height="1rem" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg>
                        </a>
                    </div>
                </header>

                <ul id="addUnlockableContent">
                    <li style="display: none;">
                        <a class="flex items-center text-gray-2">
                            <div class="body">
                                <div class="unlockable-content horizontal" id="unlockableContent<?= $i ?>">
                                    <input class="w-full" type="text" name="unlockableContent[<?= $i ?>][title]" id="title" aria-label="Titre" placeholder="Titre" minlength="6" maxlength="120" required />
 
                                    <input class="w-full" type="text" id="author" aria-label="Auteur" placeholder="Auteur" disabled value="(Vous)" />

                                    <textarea class="text-gray-2 w-full" name="unlockableContent[<?= $i ?>][description]" id="description" aria-label="Description" minlength="10" maxlength="512" placeholder="Description du contenu additionnel que les donateurs pourraient recevoir une fois l'objectif atteint." rows="5" style="resize: none;"></textarea>

                                    <div class="input-tip">
                                        <div>
                                            Points
                                        </div>
                                        <input class="w-full text-gray-less" type="number" name="unlockableContent[<?= $i ?>][points]" id="points" min="0" aria-label="Votre nombre de points" placeholder="Votre nombre de points" required />
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>                       
                </ul>
            </div>


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

            <input type="submit" value="<?= $params['edit'] ? 'Editer' : 'Créer' ?>">
        </div>
    </form>
</section>