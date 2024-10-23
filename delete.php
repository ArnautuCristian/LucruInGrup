<?php
// Include fișierul de inițializare (bootstrap.php)
require_once './bootstrap.php';

// Creează un nou obiect AngajatRepository
$angajatRepository = new AngajatRepository($databaseConnection);

// Verifică dacă a fost trimis un ID prin URL
if (isset($_GET['id'])) {
    // Obține ID-ul din URL și îl convertește într-un format sigur
    $id = htmlspecialchars($_GET['id']);
    
    // Șterge angajatul cu ID-ul respectiv
    $angajatRepository->deleteEmployee($id);
    
    // Redirecționează utilizatorul la pagina principală
    header('Location: index.php');
    exit;
}
?>
