<div class="cards-details">
    <div class="details">
        <div class="clients-details">
            <h2>Rendez-vous patients</h2>
            <a href="#" class="btn">Tout voir</a>
        </div>
        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>
        <form method="post" id="formUser" enctype="multipart/form-data">
        <div class="container">
            <h2>Patient</h2>
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <!-- Champs nom -->
                                <input required aria-describedby="lastnameHelp" type="text" name="lastname" id="lastname" title="Veuillez entrer un nom sans chiffres" placeholder="Entrez votre nom*" class="form-control <?= isset($error['lastname']) ? 'errorField' : '' ?>" autocomplete="family-name" value="<?= htmlentities($lastname ?? '') ?>" minlength="2" maxlength="70" pattern="<?= REGEX_NO_NUMBER ?>">
                                <small id="lastnameHelp" class="form-text error"><?= $error['lastname'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">
                                <!-- Champs prenom -->
                                <input required aria-describedby="firstnameHelp" type="text" name="firstname" id="firstname" title="Veuillez entrer un prénom sans chiffres" placeholder="Entrez votre prénom*" class="form-control <?= isset($error['firstname']) ? 'errorField' : '' ?>" autocomplete="firstname" value="<?= htmlentities($firstname ?? '') ?>" minlength="2" maxlength="70" pattern="<?= REGEX_NO_NUMBER ?>">
                                <small id="firstnameHelp" class="form-text error"><?= $error['firstname'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">
                                <!-- Champs email -->
                                <input required aria-describedby="mailHelp" type="mail" name="mail" id="mail" value="<?= htmlentities($mail ?? '') ?>" class="form-control <?= isset($error['mail']) ? 'errorField' : '' ?>" placeholder="Votre E-mail*" autocomplete="mail">
                                <small id="mailHelp" class="form-text error"><?= $error['mail'] ?? '' ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-4">
                            <!-- Champs numero de téléphone -->
                            <input type="tel" name="phone" id="phone" value="<?= htmlentities($phone ?? '') ?>" title="Le numéro de téléphone n' est pas au format attendu" placeholder="Numéro de téléphone" class="form-control <?= isset($error['phone']) ? 'errorField' : '' ?>" autocomplete="Tél" aria-describedby="phoneHelp">
                            <small id="phoneHelp" class="form-text error"><?= $error['phone'] ?? '' ?></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <!-- Champs date de naissance -->
                                <input type="date" name="birthdate" id="birthdate" value="<?= htmlentities($birthdate ?? '') ?>" title="La date de naissance n' est pas au format attendu" placeholder="Entrez votre date de naissance" class="form-control <?= isset($error['birthdate']) ? 'errorField' : '' ?>" autocomplete="bday" aria-describedby="birthdateHelp">
                                <small id="birthdateHelp" class="form-text error"><?= $error['birthdate'] ?? '' ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h2>Rendez-vous</h2>
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