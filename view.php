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

$editResponseMessage = "";
if (isset($_GET['success'])) {
    if ($_GET['success'] == true) {
        $editResponseMessage = "L'étudiant a bien été modifié";
    } else {
        $editResponseMessage = "Une erreur est survenue";
    }
}


include 'inc/header.php' ?>
<h1>Fiche étudiant</h1>
<button class="btn btn-primary mb-3">
    <a class="link-light text-decoration-none" href="index.php">Retour à l'accueil</a>
</button>
<div>
    <?= $editResponseMessage ?>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= $student['name'] ?></h5>
        <p class="card-text">Age: <?= $student['age'] ?></p>
        <p class="card-text">Ecole: <?= $student['school'] ?></p>
        <button class="btn btn-warning">
            <a class="link-light text-decoration-none" href="/phpCrud/edit.php?id=<?= $student['id'] ?>">Modifier</a>
        </button>
        <button class="btn btn-danger">
            <a class="link-light text-decoration-none" href="/phpCrud/delete.php?id=<?= $student['id'] ?>">Supprimer</a>
        </button>
    </div>
</div>


<?php include('inc/footer.php'); ?>