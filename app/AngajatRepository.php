<?php
class AngajatRepository implements AngajatRepositoryInterface
{
    private $pdo;

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->pdo = $databaseConnection->connect();
    }

    // Creare angajat
    public function createEmployee($nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu)
    {
        $sql = 'INSERT INTO angajati (nume, prenume, pozitie, departament, data_angajarii, salariu)
                    VALUES (:nume, :prenume, :pozitie, :departament, :data_angajarii, :salariu)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':pozitie' => $pozitie,
            ':departament' => $departament,
            ':data_angajarii' => $data_angajarii,
            ':salariu' => $salariu
        ]);
        $_SESSION['message'] = "Angajatul a fost adăugat cu succes!";
    }

    // Citire angajați
    public function readEmployees()
    {
        $sql = 'SELECT * FROM angajati';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Citire angajat după ID
    public function getById($id)
    {
        $sql = 'SELECT * FROM angajati WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizare angajat
    public function updateEmployee($id, $nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu)
    {
        $sql = 'UPDATE angajati SET nume = :nume, prenume = :prenume, pozitie = :pozitie,
                    departament = :departament, data_angajarii = :data_angajarii, salariu = :salariu WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':pozitie' => $pozitie,
            ':departament' => $departament,
            ':data_angajarii' => $data_angajarii,
            ':salariu' => $salariu,
            ':id' => $id
        ]);
        $_SESSION['message'] = "Angajatul a fost actualizat cu succes!";
    }

    // Ștergere angajat
    public function deleteEmployee($id)
    {
        $sql = 'DELETE FROM angajati WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $_SESSION['message'] = "Angajatul a fost șters cu succes!";
    }

    // Evidențiere angajați cu stagiu > 5 ani
    public function getEmployeesWithMoreThan5Years()
    {
        $sql = 'SELECT * FROM angajati WHERE TIMESTAMPDIFF(YEAR, data_angajarii, CURDATE()) > 5';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDepartmentReport()
    {
        $sql = 'SELECT departament, COUNT(*) AS numar_angajati, AVG(salariu) AS salariu_mediu 
            FROM angajati 
            GROUP BY departament';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Filtrarea dupa nume si departament
    public function filterEmployees($nume = '', $departament = '')
    {
        $sql = 'SELECT * FROM angajati WHERE 1=1';

        if (!empty($nume)) {
            $sql .= ' AND nume LIKE :nume';
        }

        if (!empty($departament)) {
            $sql .= ' AND departament = :departament';
        }

        $stmt = $this->pdo->prepare($sql);

        if (!empty($nume)) {
            $stmt->bindValue(':nume', '%' . $nume . '%', PDO::PARAM_STR);
        }

        if (!empty($departament)) {
            $stmt->bindValue(':departament', $departament, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>