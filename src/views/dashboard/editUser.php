<section class="dashboard-content">
    <h4 class="font-thin"><?= $params['edit'] ? 'Editer' : 'Créer'; ?> un utilisateur</h4>
    <form action="" method="POST">
        <div class="input-group horizontal">
            <input autofocus class="w-full" type="text" aria-label="Nom" placeholder="Nom">
            <input class="w-full" type="text" aria-label="Prénom" placeholder="Prénom">
            <input class="w-full" type="text" aria-label="Adresse e-mail" placeholder="Adresse e-mail">
         </div>
        <div class="flex justify-center horizontal">

            <div class="inline checkbox">
                <input type="radio" id="admin" name="role" aria-label="Rôle choisi: administrateur">
                <label class="w-full text-white" for="admin">Administrateur</label>
            </div>
            <div class="inline checkbox">
                <input type="radio" id="org" name="role" aria-label="Rôle choisi: organisateur">
                <label class="w-full text-white" for="org">Organisateur</label>
            </div>
            <div class="inline checkbox">
                <input type="radio" id="jury" name="role" aria-label="Rôle choisi: jury">
                <label class="w-full text-white" for="jury">Jury</label>
            </div>
            <div class="inline checkbox">
                <input type="radio" id="donor" name="role" aria-label="Rôle choisi: donateur">
                <label class="w-full text-white" for="donor">Donateur</label>
            </div>
            <div class="inline checkbox">
                <input type="radio" id="public" name="role" aria-label="Rôle choisi: public">
                <label class="w-full text-white" for="public">Public</label>
            </div>
        </div>

        <p style="margin-top: 1.5rem; text-align: justify; font-size: large">
            <i>
                Le mot de passe sera créé par l'utilisateur lors de sa première connexion.
            </i>
        </p>

        <div class="actions">
            <input type="submit" value="Créer">
        </div>
    </form>
</section>