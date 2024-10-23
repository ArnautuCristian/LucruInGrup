<?php
require_once './bootstrap.php';
$angajatRepository = new AngajatRepository($databaseConnection);

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $angajatRepository->deleteEmployee($id);
    header('Location: index.php');
    exit;
}
