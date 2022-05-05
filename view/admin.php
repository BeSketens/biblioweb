<div class="centered">
    <h1 class="center-text">Administration</h1>
    <div id="admin-container">
        <section>
            <h2>Liste des membres</h2>
            <table>
                <thead>
                <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Date d'arrivée</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < sizeof($members); $i++) { ?>
                    <tr>
                        <td><?= $members[$i]['login'] ?></td>
                        <td><?= $members[$i]['email'] ?></td>
                        <td><?= $members[$i]['statut'] ?></td>
                        <td><?= $members[$i]['created_at'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
        <section>
            <h2>Liste des auteurs <span><a href="<?= DOMAIN ?>admin?author&authorAction=add"><button>Ajouter</button></a></span></h2>
            <table>
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nationalité</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < sizeof($authors); $i++) { ?>
                    <tr>
                        <td><?= $authors[$i]['lastname'] ?></td>
                        <td><?= $authors[$i]['firstname'] ?></td>
                        <td><?= $authors[$i]['nationality'] ?></td>
                        <td><a href="<?= DOMAIN ?>admin?author&authorAction=modify&id=<?= $authors[$i]['id'] ?>"><button>Modifier</button></a></td>
                        <td><a href="<?= DOMAIN ?>admin?author&authorAction=delete&id=<?= $authors[$i]['id'] ?>"><button>Supprimer</button></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
