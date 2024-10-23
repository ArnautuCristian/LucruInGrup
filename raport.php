<?php
// Include fișierul de inițializare (bootstrap.php)
require_once './bootstrap.php';

// Creează un nou obiect AngajatRepository
$angajatRepository = new AngajatRepository($databaseConnection);

// Obținem raportul pe departamente
$raportDepartamente = $angajatRepository->getDepartmentReport();
?>

<!-- Afișează raportul pe departamente -->

<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Raport pe Departamente</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Raport pe Departamente</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Departament</th>
                    <th>Număr Angajați</th>
                    <th>Salariu Mediu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($raportDepartamente as $raport): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($raport['departament']); ?></td>
                        <td><?php echo htmlspecialchars($raport['numar_angajati']); ?></td>
                        <td><?php echo number_format($raport['salariu_mediu'], 2); ?> lei</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-info mb-5">Inapoi la index</a>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
