<?php
// Include fișierul 'bootstrap.php' pentru a inițializa aplicația, încărcând toate dependențele necesare, inclusiv conexiunea la baza de date și alte configurări.
require_once './bootstrap.php';
// Creează o instanță a clasei 'AngajatRepository', folosind conexiunea la baza de date pentru a interacționa cu datele angajaților.
$angajatRepository = new AngajatRepository($databaseConnection);
// Verifică dacă există un parametru 'id' în URL. Acesta este utilizat pentru a identifica angajatul care va fi editat. 
if (isset($_GET['id'])) {
    // Curăță valoarea primită prin GET pentru a preveni atacurile de tip XSS (cross-site scripting).
    $id = htmlspecialchars($_GET['id']);
    // Obține datele angajatului din baza de date pe baza ID-ului.
    $angajat = $angajatRepository->getById($id);
    // Verifică dacă metoda de trimitere a formularului este 'POST', ceea ce indică faptul că datele formularului au fost trimise pentru actualizare.
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