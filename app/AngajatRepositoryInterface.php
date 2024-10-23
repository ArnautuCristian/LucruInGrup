<?php
interface AngajatRepositoryInterface
{
    public function createEmployee($nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu);
    public function readEmployees();
    public function getById($id);
    public function updateEmployee($id, $nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu);
    public function deleteEmployee($id);
    public function getEmployeesWithMoreThan5Years();
}
