<?php
// Include fișierul de inițializare (bootstrap.php)
require_once './bootstrap.php';

// Creează un nou obiect AngajatRepository
$angajatRepository = new AngajatRepository($databaseConnection);

// Verifică dacă există un ID trimis prin URL
if (isset($_GET['id'])) {
    // Obține ID-ul din URL și îl convertește într-un format sigur
    $id = htmlspecialchars($_GET['id']);
    
    // Obține datele angajatului pe baza ID-ului
    $angajat = $angajatRepository->getById($id);

    // Verifică dacă metoda de trimitere a formularului este POST (actualizare angajat)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obține datele introduse de utilizator din formular
        $nume = $_POST['nume'];
        $prenume = $_POST['prenume'];
        $pozitie = $_POST['pozitie'];
        $departament = $_POST['departament'];
        $data_angajarii = $_POST['data_angajarii'];
        $salariu = $_POST['salariu'];
        
        // Actualizează angajatul cu datele primite
        $angajatRepository->updateEmployee($id, $nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu);
        
        // Redirecționează utilizatorul la pagina principală
        header('Location: index.php');
        exit;
    }
}
?>
