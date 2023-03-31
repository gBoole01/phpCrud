<?php
require 'inc/connect.php';

$nameError = "";
$ageError = "";
$schoolError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ? $_POST['name'] : '';
    $age = $_POST['age'] ? $_POST['age'] : '';
    $school = $_POST['school'] ? $_POST['school'] : '';

    if (empty($name)) {
        $nameError = "Le nom est obligatoire";
    }
    if (!is_numeric($age)) {
        $ageError = "L'age doit être un nombre";
    }
    if (empty($age)) {
        $ageError = "L'age est obligatoire";
    }
    if (empty($school)) {
        $schoolError = "L'école est obligatoire";
    }
    if (empty($nameError) && empty($ageError) && empty($schoolError)) {
        $query = "INSERT INTO students (name, age, school) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sis', $name, $age, $school);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: index.php");
    }
}


include 'inc/header.php'
    ?>
<h1>Ajouter un étudiant</h1>
<a href="index.php">Retour à l'accueil</a>
<form action="/phpCrud/create.php" method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input id="name" name="name" type="text">
        <span class="error">
            <?= $nameError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input id="age" name="age" type="text">
        <span class="error">
            <?= $ageError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="school">Ecole</label>
        <input id="school" name="school" type="text">
        <span class="error">
            <?= $schoolError ?>
        </span>
    </div>
    <button type="submit">Ajouter</button>
</form>


<?php include('inc/footer.php'); ?>