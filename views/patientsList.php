<div class="cards-details">
    <div class="details">
        <div class="clients-details">
            <h2>Liste des patients</h2>
            <a href="/creation-patients" class="btn">Créer nouvelle fiche patient</a>
        </div>

        <label>
            <input id="searchbar" onkeyup="search_patient()" type="text" placeholder="Recherche">
            <ion-icon name="search-outline"></ion-icon>
        </label>
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
                    <td class="patient"><a href="/liste-patients?id=<?= $patient->id ?>">Suprimer</a></td>
                <?php
            }
                ?>
                </tr>
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