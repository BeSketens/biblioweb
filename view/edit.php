<?php if (isset($dataArray['error'])) { ?>
    <!-- ERROR NO REFERENCE -->
    <div class="fixed-centered">
        <h1>Erreur de sélection du livre</h1>
        <a href="<?= DOMAIN ?>">Retour à la liste des livres</a>
    </div>
<?php } elseif (isset($dataArray['success'])) { ?>
    <!-- SUCCESS MODIFICATION -->
    <div class="fixed-centered">
        <h1>Modification effectuée</h1>
        <a href="<?= DOMAIN ?>">Retour à la liste des livres</a>
    </div>
<?php } else { ?>
        <div class="fixed-centered">
            <!-- EDIT FORM -->
            <form action="<?= DOMAIN ?>edit/<?= $reference ?>" method="post">
                <section>
                    <h2>Modifier livre</h2>
                    <input type="hidden" name="ref" value="<?= $dataArray['ref'] ?>">
                    <label>
                        Titre
                        <input autocomplete="off" type="text" name="title" value="<?= $dataArray['title'] ?>">
                    </label>
                    <label>
                        Description
                        <input autocomplete="off" type="text" name="description" value="<?= $dataArray['description'] ?>">
                    </label>
                    <label>
                        Illustration
                        <input autocomplete="off" type="file" name="cover_url" value="<?= $dataArray['cover_url'] ?>">
                        </label>
                    <label>
                        Auteur
                        <!-- select dynamique à implémenter -->
                        <select name="author_id">
                            <option hidden value="">Choisissez</option>
                            <option value="1">Bob Sull</option>
                            <option value="2">Fred Sull</option>
                            <option value="3">Lydia Sull</option>
                            <option value="4">Philip K. Dick</option>
                        </select>
                    </label>
                </section>    
                <button type="submit" name="submit">Modifier</button>
            </form>
            <!-- ERROR MODIFICATION -->
            <?php if (!empty($error)) { ?>
                    <p class="error center-text"><?= $error ?></p>
            <?php } ?>
        </div>
        
<?php } ?>

    <div class="centered" style="color:brown">
        <h3>Le formulaire ne modifie rien pour le moment</h3>
    </div>
