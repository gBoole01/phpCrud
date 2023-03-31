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


include 'inc/header.php'
    ?>
<h1>Fiche étudiant</h1>
<a href="index.php">Retour à l'accueil</a>
<div>
    <?= $editResponseMessage ?>
</div>

<div>
    <?= $student['name'] ?>
</div>
<div>
    <?= $student['age'] ?>
</div>
<div>
    <?= $student['school'] ?>
</div>
<a href="/phpCrud/edit.php?id=<?= $student['id'] ?>">Modifier</a>
<a href="/phpCrud/delete.php?id=<?= $student['id'] ?>">Supprimer</a>

<?php include('inc/footer.php'); ?>