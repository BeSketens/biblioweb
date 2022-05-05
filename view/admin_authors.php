<?php if (!isset($id)) { ?>
        <!-- ADD AUTHOR -->
        <div class="centered">
            <h1 class="center-text">Ajout d'un auteur</h1>
            <?php if (isset($successMsg)) { ?>
                <h3 class="center-text success"><?= $successMsg ?></h3>
            <?php } elseif (isset($errorMsg)) { ?>
                <h3 class="center-text error"><?= $errorMsg ?></h3>
            <?php } ?>
            <form action="<?= DOMAIN ?>admin?author&authorAction=add" method="post">
                <div>
                    <section>
                        <label>
                            Nom
                            <input required type="text" name="lastname">
                        </label>
                        <label>
                            Prénom
                            <input required type="text" name="firstname">
                        </label>
                        <label>
                            Nationalité
                            <input required type="text" name="nationality">
                        </label>
                    </section>
                    <button name="add-author-submit">Ajouter</button>
                </div>
            </form>
            <a href="<?= DOMAIN ?>admin">
                <button>Retourner vers l'administration</button>
            </a>
        </div>

<?php } else { ?>
        <!-- MODIFY -->
        <?php if ($author) { ?>
            <div class="centered">
                <h1 class="center-text">Modification d'un auteur</h1>
                <?php if (isset($successMsg)) { ?>
                    <h3 class="center-text success"><?= $successMsg ?></h3>
                <?php } elseif (isset($errorMsg)) { ?>
                    <h3 class="center-text error"><?= $errorMsg ?></h3>
                <?php } ?>
                <form action="<?= DOMAIN ?>admin?author&authorAction=modify&id=<?= $author['id'] ?>" method="post">
                    <div>
                        <section>
                            <label>
                                Nom
                                <input type="text" name="lastname" placeholder="<?= $author['lastname'] ?>">
                            </label>
                            <label>
                                Prénom
                                <input type="text" name="firstname" placeholder="<?= $author['firstname'] ?>">
                            </label>
                            <label>
                                Nationalité
                                <input type="text" name="nationality" placeholder="<?= $author['nationality'] ?>">
                            </label>
                        </section>
                        <button name="modify-author-submit">Modifier</button>
                    </div>
                </form>
                <a href="<?= DOMAIN ?>admin">
                    <button style="margin-left: 40px">Retourner vers l'administration</button>
                </a>
            </div>
        <?php } else { ?>
            <div class="fixed-centered">
                <h1>Auteur sélectionné invalide</h1>
                <a href="<?= DOMAIN ?>admin">Retourner vers l'administration</a>
            </div>
        <?php }
    } ?>
