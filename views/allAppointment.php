<div class="cards-details">
    <div class="details">
        <div class="clients-details">
            <h2>Liste des rendez-vous</h2>
            <a href="/rendez-vous-patients" class="btn">Créer un rendez-vous</a>
        </div>
        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>
        <table>
            <thead>
                <tr>
                    <td>Nom</td>
                    <td>Prénom</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient) { ?>
                    <tr>
                        <td class="patient"><?= $patient->firstname ?></td>
                        <td class="patient"><?= $patient->lastname ?></td>
                        <td><a href="/rendez-vous-patient?id=<?= $patient->id ?>">voir le rendez-vous</a></td>
                        <td><a href="/suprimer-rendez-vous?id=<?= $patient->id ?>">Suprimer</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>