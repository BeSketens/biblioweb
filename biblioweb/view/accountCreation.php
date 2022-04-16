<div class="fixed-centered">
    <!-- ERRORS -->
    <?php if (!empty($error)) { ?>
        <p class="error center-text"><?= $error ?></p>
    <?php } ?>
    <!-- FORM -->
    <form action="<?= DOMAIN ?>create-account" method="post">
        <div>
            <section>
                <h2>Création compte</h2>
                <label>
                    Nom d'utilisateur
                    <input autocomplete="off" type="text" name="username">
                </label>
                <label>
                    Email
                    <input autocomplete="off" type="email" name="email">
                </label>
                <label>
                    Mot de passe
                    <input autocomplete="off" type="password" name="password">
                </label>
                <label>
                    Statut
                    <select name="status">
                        <option value="">Choisissez</option>
                        <option value="novice">Novice</option>
                        <option value="expert">Expert</option>
                    </select>
                </label>
            </section>
        </div>
        <button type="submit" name="submit">Créer</button>
    </form>
</div>