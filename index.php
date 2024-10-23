<?php
    session_start();
    require_once './bootstrap.php';
    $angajatRepository = new AngajatRepository($databaseConnection);
    $angajati = $angajatRepository->readEmployees();
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestionare Angajați</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Adaugă Angajat</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nume" class="form-label">Nume</label>
                <input type="text" class="form-control" id="nume" name="nume" required>
            </div>
            <div class="mb-3">
                <label for="prenume" class="form-label">Prenume</label>
                <input type="text" class="form-control" id="prenume" name="prenume" required>
            </div>
            <div class="mb-3">
                <label for="pozitie" class="form-label">Poziție</label>
                <input type="text" class="form-control" id="pozitie" name="pozitie" required>
            </div>
            <div class="mb-3">
                <label for="departament" class="form-label">Departament</label>
                <input type="text" class="form-control" id="departament" name="departament" required>
            </div>
            <div class="mb-3">
                <label for="data_angajarii" class="form-label">Data Angajării</label>
                <input type="date" class="form-control" id="data_angajarii" name="data_angajarii" required>
            </div>
            <div class="mb-3">
                <label for="salariu" class="form-label">Salariu</label>
                <input type="number" class="form-control" id="salariu" name="salariu" required>
            </div>
            <button type="submit" class="btn btn-primary">Adaugă</button>
        </form>
    </div>

    <div class="container mt-5">
        <?php if (isset($_SESSION['mesaj'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['mesaj'];
                unset($_SESSION['mesaj']);
                ?>
            </div>
        <?php endif; ?>
        
        <h2 class="mb-4">Lista Angajaților</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Poziție</th>
                    <th>Departament</th>
                    <th>Data Angajării</th>
                    <th>Salariu</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($angajati as $angajat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($angajat['id']); ?></td>
                        <td><?php echo htmlspecialchars($angajat['nume']); ?></td>
                        <td><?php echo htmlspecialchars($angajat['prenume']); ?></td>
                        <td><?php echo htmlspecialchars($angajat['pozitie']); ?></td>
                        <td><?php echo htmlspecialchars($angajat['departament']); ?></td>
                        <td><?php echo htmlspecialchars($angajat['data_angajarii']); ?></td>
                        <td><?php echo htmlspecialchars($angajat['salariu']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $angajat['id']; ?>" class="btn btn-warning btn-sm">Actualizează</a>
                            <a href="delete.php?id=<?php echo $angajat['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Ești sigur că vrei să ștergi acest angajat?');">Șterge</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// create_employee.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $pozitie = $_POST['pozitie'];
    $departament = $_POST['departament'];
    $data_angajarii = $_POST['data_angajarii'];
    $salariu = $_POST['salariu'];
    $angajatRepository->createEmployee($nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu);
    header('Location: index.php');
    exit;
}
