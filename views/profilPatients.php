<div class="cards-details">
    <div class="details">
        <div class="clients-details">
            <h2>Patient</h2>
            <a href="/liste-patients" class="btn">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Date de naissance</td>
                    <td>Téléphone</td>
                    <td>E-mail</td>
                    <td>N° de Sécurité Sociale</td>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $patient->lastname ?></td>
                    <td><?= $patient->firstname ?></td>
                    <td><?= date("d-m-Y", strtotime($patient->birthdate)) ?></td>
                    <td><?= $patient->phone ?></td>
                    <td><?= $patient->mail ?></td>
                    <td></td>
                    <td><a href="/modif-patient?id=<?= $patient->id ?>">Modifier</a></td>
                    <td><a href="/liste-patients?id=<?= $patient->id ?>">Suprimer</a></td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <td>Date rendez-vous</td>
                    <td>Heure rendez-vous</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="patient"><?= date("d-m-Y", strtotime($appointment->dateHour)) ?></td>
                    <td class="patient"><?= date("H:i", strtotime($appointment->dateHour)) ?></td>
                    <td></td>
                    <td><a href="/modif-appointment?id=<?= $appointment->id ?>">Modifier</a></td>
                    <td><a href="/liste-patients?id=<?= $patient->id ?>">Suprimer</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>