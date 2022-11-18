<div class="cards-details">
    <div class="details">
        <div class="clients-details">
            <h2>Liste des patients</h2>
            <a href="/creation-patients" class="btn">Créer nouvelle fiche patient</a>
        </div>

        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>

        <div class="search-bar">
            <form method="get">
                <input type="search" placeholder="Recherche..." name="search">
                <input type="submit" value="valider" name="valider">
            </form>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Voir plus</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient) { ?>
                <tr>
                    <td class="patient"><?= $patient->lastname ?></td>
                    <td><?= $patient->firstname ?></td>
                    <td><a href="/profil-patients?id=<?= $patient->id ?>" class="complete-file">
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </a></td>
                    <td class="patient"><a href="/suprimer-patient?id=<?= $patient->id ?>">Suprimer</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <ul class="pagination">
        <li class="page-item">
            <a href="./liste-patients?page=<?= $whichPage - 1 ?>" class="page-link">Précédente</a>
        </li>

        <li class="page-item">
            <a href="./liste-patients?page=<?= $whichPage + 1 ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</div>
</div>