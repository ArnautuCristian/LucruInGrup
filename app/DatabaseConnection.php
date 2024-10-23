<?php
// Clasa responsabilă de gestionarea conexiunii la baza de date
class DatabaseConnection implements DatabaseConnectionInterface
{
    // Atribut pentru DSN-ul bazei de date
    private $dsn;
    
    // Atribut pentru numele de utilizator al bazei de date
    private $username;
    
    // Atribut pentru parola bazei de date
    private $password;

    // Constructor pentru setarea DSN-ului, numelui de utilizator și parolei
    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
    }

    // Metodă pentru a realiza conexiunea la baza de date
    public function connect()
    {
        try {
            // Inițializarea conexiunii PDO cu setările DSN, username și parolă
            $pdo = new PDO($this->dsn, $this->username, $this->password);
            
            // Setarea modului de raportare a erorilor pentru conexiune
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            // În cazul unei erori, afișează un mesaj și oprește execuția
            die('Conexiunea la baza de date a eșuat: ' . $e->getMessage());
        }
    }
}
?>
