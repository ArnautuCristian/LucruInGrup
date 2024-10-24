<?php
require_once './bootstrap.php';
$angajatRepository = new AngajatRepository($databaseConnection);
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $angajat = $angajatRepository->getById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nume = $_POST['nume'];
        $prenume = $_POST['prenume'];
        $pozitie = $_POST['pozitie'];
        $departament = $_POST['departament'];
        $data_angajarii = $_POST['data_angajarii'];
        $salariu = $_POST['salariu'];
        $angajatRepository->updateEmployee($id, $nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizează Angajat</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Actualizează Angajat</h2>
        <form action="?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="nume" class="form-label">Nume</label>
                <input type="text" class="form-control" id="nume" name="nume"
                    value="<?php echo htmlspecialchars($angajat['nume']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenume" class="form-label">Prenume</label>
                <input type="text" class="form-control" id="prenume" name="prenume"
                    value="<?php echo htmlspecialchars($angajat['prenume']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="pozitie" class="form-label">Poziție</label>
                <input type="text" class="form-control" id="pozitie" name="pozitie"
                    value="<?php echo htmlspecialchars($angajat['pozitie']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="departament" class="form-label">Departament</label>
                <input type="text" class="form-control" id="departament" name="departament"
                    value="<?php echo htmlspecialchars($angajat['departament']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="data_angajarii" class="form-label">Data Angajării</label>
                <input type="date" class="form-control" id="data_angajarii" name="data_angajarii"
                    value="<?php echo htmlspecialchars($angajat['data_angajarii']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="salariu" class="form-label">Salariu</label>
                <input type="number" class="form-control" id="salariu" name="salariu"
                    value="<?php echo htmlspecialchars($angajat['salariu']); ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizează</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>