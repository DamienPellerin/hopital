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
                    <td>Date</td>
                    <td>Heure</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="patient"><?= date("d-m-Y", strtotime($appointment->dateHour)) ?></td>
                    <td class="patient"><?= date("H:i", strtotime($appointment->dateHour)) ?></td>
                    <td><a href="/modif-appointment?id=<?= $appointment->id ?>">Modifier</a></td>
                    <td><a href="/liste-rendez-vous?id=<?= $appointment->id ?>">Suprimer</a></td>
                </tr>
            </tbody>
        </table>
         
    </div>
</div>