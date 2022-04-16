<div class="fixed-centered">
    <!-- ERRORS -->
    <?php if (!empty($error)) { ?>
        <p class="error center-text"><?= $error ?></p>
    <?php } ?>
    <!-- FORM -->
    <form action="<?= DOMAIN ?>login" method="post">
        <div>
            <section>
                <h2>Connexion</h2>
                <label>
                    Email
                    <input autocomplete="off" type="email" name="email">
                </label>
                <label>
                    Mot de passe
                    <input autocomplete="off" type="password" name="password">
                </label>
            </section>
        </div>
        <button type="submit" name="submit">Connexion</button>
    </form>
</div>