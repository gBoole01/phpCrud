<?php
require 'inc/connect.php';

$studentId = $_GET['id'] ? $_GET['id'] : null;
if (!isset($studentId)) {
    header("Location: index.php");
}
$query = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $studentId);
$stmt->execute();
$result = $stmt->get_result();
$student = mysqli_fetch_assoc($result);

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
        $query = "UPDATE students SET name = ?, age = ?, school = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sisi', $name, $age, $school, $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: view.php?id=" . $studentId . "&success=true");
    } else {
        header("Location: view.php?id=" . $studentId . "&success=false");
    }
}


include 'inc/header.php'
    ?>
<h1>Modifier l'étudiant</h1>
<a href="index.php">Retour à l'accueil</a>

<form action="/phpCrud/edit.php?id=<?= $student['id'] ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input value="<?= $student['name'] ?>" id="name" name="name" type="text">
        <span class="error">
            <?= $nameError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input value="<?= $student['age'] ?>" id="age" name="age" type="text">
        <span class="error">
            <?= $ageError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="school">Ecole</label>
        <input value="<?= $student['school'] ?>" id="school" name="school" type="text">
        <span class="error">
            <?= $schoolError ?>
        </span>
    </div>
    <button type="submit">Modifier</button>
</form>


<?php include('inc/footer.php'); ?>