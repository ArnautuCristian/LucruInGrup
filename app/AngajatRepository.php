<?php
// Clasa AngajatRepository implementează interfața AngajatRepositoryInterface
class AngajatRepository implements AngajatRepositoryInterface
{
    // Proprietate pentru a stoca conexiunea la baza de date
    private $pdo;

    // Constructorul clasei care primește o conexiune la baza de date
    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        // Inițializăm proprietatea cu conexiunea PDO
        $this->pdo = $databaseConnection->connect();
    }

    // Metodă pentru crearea unui angajat nou în baza de date
    public function createEmployee($nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu)
    {
        // Definim interogarea SQL pentru a insera un angajat nou
        $sql = 'INSERT INTO angajati (nume, prenume, pozitie, departament, data_angajarii, salariu)
                    VALUES (:nume, :prenume, :pozitie, :departament, :data_angajarii, :salariu)';

        // Pregătim interogarea pentru execuție
        $stmt = $this->pdo->prepare($sql);

        // Executăm interogarea cu parametrii furnizați
        $stmt->execute([
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':pozitie' => $pozitie,
            ':departament' => $departament,
            ':data_angajarii' => $data_angajarii,
            ':salariu' => $salariu
        ]);

        // Setăm un mesaj de succes în sesiune
        $_SESSION['message'] = "Angajatul a fost adăugat cu succes!";
    }

    // Metodă pentru citirea tuturor angajaților din baza de date
    public function readEmployees()
    {
        // Definim interogarea SQL pentru a selecta toți angajații
        $sql = 'SELECT * FROM angajati';

        // Executăm interogarea și returnăm rezultatul ca array asociativ
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metodă pentru a citi un angajat după ID
    public function getById($id)
    {
        // Definim interogarea SQL pentru a selecta un angajat pe baza ID-ului
        $sql = 'SELECT * FROM angajati WHERE id = :id';

        // Pregătim interogarea pentru execuție
        $stmt = $this->pdo->prepare($sql);

        // Executăm interogarea cu parametrul ID
        $stmt->execute([':id' => $id]);

        // Returnăm rezultatul sub formă de array asociativ
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Metodă pentru actualizarea unui angajat în baza de date
    public function updateEmployee($id, $nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu)
    {
        // Definim interogarea SQL pentru actualizarea angajatului
        $sql = 'UPDATE angajati SET nume = :nume, prenume = :prenume, pozitie = :pozitie,
                    departament = :departament, data_angajarii = :data_angajarii, salariu = :salariu WHERE id = :id';

        // Pregătim interogarea pentru execuție
        $stmt = $this->pdo->prepare($sql);

        // Executăm interogarea cu parametrii furnizați
        $stmt->execute([
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':pozitie' => $pozitie,
            ':departament' => $departament,
            ':data_angajarii' => $data_angajarii,
            ':salariu' => $salariu,
            ':id' => $id
        ]);

        // Setăm un mesaj de succes în sesiune
        $_SESSION['message'] = "Angajatul a fost actualizat cu succes!";
    }

    // Metodă pentru ștergerea unui angajat pe baza ID-ului
    public function deleteEmployee($id)
    {
        // Definim interogarea SQL pentru ștergerea unui angajat
        $sql = 'DELETE FROM angajati WHERE id = :id';

        // Pregătim interogarea pentru execuție
        $stmt = $this->pdo->prepare($sql);

        // Executăm interogarea cu parametrul ID
        $stmt->execute([':id' => $id]);

        // Setăm un mesaj de succes în sesiune
        $_SESSION['message'] = "Angajatul a fost șters cu succes!";
    }

    // Metodă pentru obținerea angajaților cu mai mult de 5 ani de stagiu
    public function getEmployeesWithMoreThan5Years()
    {
        // Definim interogarea SQL pentru a selecta angajații cu peste 5 ani de experiență
        $sql = 'SELECT * FROM angajati WHERE TIMESTAMPDIFF(YEAR, data_angajarii, CURDATE()) > 5';

        // Executăm interogarea și returnăm rezultatul ca array asociativ
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metodă pentru generarea unui raport pe departamente
    public function getDepartmentReport()
    {
        // Definim interogarea SQL pentru a obține numărul de angajați și salariul mediu pe fiecare departament
        $sql = 'SELECT departament, COUNT(*) AS numar_angajati, AVG(salariu) AS salariu_mediu 
            FROM angajati 
            GROUP BY departament';

        // Pregătim interogarea pentru execuție
        $stmt = $this->pdo->prepare($sql);

        // Executăm interogarea și returnăm rezultatul ca array asociativ
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metodă pentru filtrarea angajaților pe baza numelui și a departamentului
    public function filterEmployees($nume = '', $departament = '')
    {
        // Definim interogarea SQL de bază
        $sql = 'SELECT * FROM angajati WHERE 1=1';

        // Adăugăm filtrul pentru nume dacă este furnizat
        if (!empty($nume)) {
            $sql .= ' AND nume LIKE :nume';
        }

        // Adăugăm filtrul pentru departament dacă este furnizat
        if (!empty($departament)) {
            $sql .= ' AND departament = :departament';
        }

        // Pregătim interogarea pentru execuție
        $stmt = $this->pdo->prepare($sql);

        // Legăm parametrii pentru nume și departament, dacă există
        if (!empty($nume)) {
            $stmt->bindValue(':nume', '%' . $nume . '%', PDO::PARAM_STR);
        }

        if (!empty($departament)) {
            $stmt->bindValue(':departament', $departament, PDO::PARAM_STR);
        }

        // Executăm interogarea și returnăm rezultatul ca array asociativ
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>