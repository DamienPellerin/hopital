<div class="cards-details">
    <div class="details">
        <div class="clients-details">
            <h2>Rendez-vous patients</h2>
            <a href="#" class="btn">Tout voir</a>
        </div>

        <form method="post" id="formUser" enctype="multipart/form-data">
            <div class="col">
                <div class="mb-4">
                    <!-- Champs jour -->
                    <input type="date" value="<?= date('Y-m-d', strtotime($appointment->dateHour))  ?? '' ?>" name="date">
                    <small id="appointment-dayHelp" class="form-text error"><?= $error['appointment-day'] ?? '' ?></small>
                </div>
            </div>
            <div class="col">
                <div class="mb-4">
                    <!-- Champs heure -->
                    <select name="hour" id="hour" class="form-control" aria-describedby="appointment-hourHelp">

                        <?php foreach ($hours as  $hour) { ?>
                            <option><?= $hour ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small id="appointment-hourHelp" class="form-text error"><?= $error['appointment-hour'] ?? '' ?></small>
                </div>
                <p><?= $updateMessage ?? '' ?></p>
            </div>
    </div>

    <input type="submit" value="Enregistrer le patient" class="btn btn-primary mt-3" id="validForm">
    <p><?= $updateMessage ?? '' ?></p>
</div>

</form>
</div>
</div>