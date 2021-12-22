<section class="dashboard-content">
    <h1>Créer un utilisateur</h2>
    <form action="/my-mvc-template/signin/auth" method="POST">
        <div class="w-1/2 input-group horizontal">
            <input class="w-full text-white" type="text" aria-label="Son nom" placeholder="Votre nom">
            <input class="w-full text-white" type="text" aria-label="Son prénom" placeholder="Votre prénom">
            <input class="w-full text-white" type="text" aria-label="Son adresse-mail" placeholder="Votre adresse-mail">
            <input class="w-full text-white" type="text" aria-label="Son mot de passe" placeholder="Votre mot de passe">
         </div>
        <div class="flex justify-center w-1/2 horizontal">

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

        <div class="actions">
            <input type="submit" value="Créer">
            <a>Mot de passe oublié?</a>
        </div>
    </form>
</section>