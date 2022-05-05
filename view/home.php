<form action="<?= DOMAIN ?>filter" method="get">
    <div>
        <label>
            Filtre
            <input type="text" name="key" placeholder="Titre du livre">
        </label>
    </div>
    <button type="submit">Rechercher</button>
</form>
<div id="books-container">
<?php foreach($books as $book) { ?>
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
<?php } ?>
</div>