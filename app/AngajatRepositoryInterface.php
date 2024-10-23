<?php
// Definește o interfață pentru a interacționa cu datele angajaților
interface AngajatRepositoryInterface
{
    // Metodă pentru crearea unui angajat nou
    public function createEmployee($nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu);
    
    // Metodă pentru citirea tuturor angajaților
    public function readEmployees();
    
    // Metodă pentru obținerea unui angajat după ID
    public function getById($id);
    
    // Metodă pentru actualizarea unui angajat existent
    public function updateEmployee($id, $nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu);
    
    // Metodă pentru ștergerea unui angajat după ID
    public function deleteEmployee($id);
    
    // Metodă pentru obținerea angajaților cu stagiu mai mare de 5 ani
    public function getEmployeesWithMoreThan5Years();
    
    // Metodă pentru obținerea unui raport al departamentelor
    public function getDepartmentReport();
}
?>
