<div class="cards-details">
    <div class="details">
        <div class="clients-details">
            <h2>Rendez-vous patients</h2>
            <a href="#" class="btn">Tout voir</a>
        </div>

        <form method="post" id="formUser" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <select name="id" id="firstname" class="form-control" aria-describedby="firstnameHelp">
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?=$patient->id?>"><?= $patient->firstname .' '. $patient->lastname ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <div class="mb-4">
                            <!-- Champs jour -->
                         <input type="date" name="date">
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

            </div>

        </form>
    </div>
</div>