<?php if (isset($books)) { ?>
        <div id="books-container">
<?php   foreach($books as $book) { ?>
            <article>
                <h2 class="submain-color"><?= $book['title'] ?></h2>
                <figure>
                    <img src="<?= $book['cover_url'] ?>" alt="<?= $book['title'] ?>" width="100">
                    <figcaption><?= $book['title'] ?></figcaption>
                </figure>
                <p><?= $book['description'] ?></p>
                <?php if (IS_CONNECTED && $_SESSION['status'] == 'admin') { ?>
                    <a href="<?= DOMAIN ?>edit/<?= $book['ref'] ?>">Modifier</a>
                <?php } ?>
            </article>
<?php   } ?>
        </div>
        <div class="centered">
            <a href="<?= DOMAIN ?>">
                <h4>Retour à la liste des livres</h4>
            </a>
        </div>
<?php } else { ?>
        <div class="centered">
            <h1>Pas de filtre de recherche</h1>
            <a href="<?= DOMAIN ?>">Retour à la liste des livres</a>
        </div>
<?php } ?>
        