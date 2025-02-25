<?php

use \DateTime; 

/**
 * Allows Connection to the MySQL database and stores result in cache
 * 
 */
class CitationDatabase {

    private string $db_user;
    private string $db_password;
    private string $db_host;
    private string $db_name;

    private $citations = array();
    private $authors = array();
    
    public function __construct($db_user, $db_password, $db_host, $db_name) {
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->db_host = $db_host;
        $this->db_name = $db_name;
    }

    private function connectToDatabase() {
        try {
            $pdo=new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user,
            $this->db_password, array(PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION));
        
        } catch (PDOException $e) {
            echo "Database Connexion Error<br>";
            echo $e->getMessage();
        }
    
        return $pdo;
    }

    
    private function closeConnection($pdo) {
        $pdo = null;
    }


    /**
     * Handles adding a citation to the database
     */
    public function addCitation(string $login,
                                Author $author,
                                string $text,
                                string $date) {
        
        if (!$this->isValidParameters($login, $author, $text, $date)) {
            throw new IllegalParametersException("TO DO : STUB MESSAGE");
        }
        
        // Private acces to database
        $pdo = $this->connectToDatabase();
        $pdo->beginTransaction();

        // Update cache
        $this->fetchCitations();
        
        // Author handling
        if (!$this->isAuthorInDatabase($author)) {
            $author_id = $this->addAuthorToDatabase($author, $pdo);
            $author->setId($author_id);
            array_push($this->authors, $author);
        }

        // Citation handling
        
        $citation = new Citation($login, $author, $text, $date, Date("Y-m-d"));
        $citation_id = $this->addCitationToDatabase($citation, $pdo);
        
        // End transaction
        $pdo->commit();
        $this->closeConnection($pdo);
        
        // Update cache
        $this->citations[$citation_id] = $citation;
        return;
    }

    private function addAuthorToDatabase($author, $pdo) {
        $sql = "INSERT INTO Author(surname, name, birth_date) VALUES (?, ?, ?);";
        try {
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->execute([$author->getSurname(), $author->getName(), $author->getDate()]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "". $e->getMessage() ."";
            return null;
        }
    }

    private function addCitationToDatabase($citation, $pdo) {
        $sql = "INSERT INTO Citation(author_id, login, text, date, creation_date) VALUES (?, ?, ?, ?, CURRENT_DATE());";
        try {
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->execute([
                (int) $citation->getAuthor()->getId(),
                $citation->getLogin(),
                $citation->getText(),
                $citation->getDate()
            ]);
            return $pdo->lastInsertId();
        } catch (Exception $e) {
            echo "". $e->getMessage() ."";
            return null;
        }
        
    }

    /**
     * Summary of getCitations
     * @param mixed $pdo
     * @return array
     */
    function fetchCitations(): void {
        $this->fetchAuthors();
        $pdo = $this->connectToDatabase();

        $sql = "SELECT c.citation_id, c.login, c.text, c.date, c.creation_date, a.author_id, a.surname, a.name, a.birth_date   from Citation as c JOIN Author as a ON c.author_id = a.author_id";
        $pdoStatement=$pdo->query($sql);
        $this->citations = array();
        
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
                $citation = new Citation($row["login"],
                                        $this->authors[$row["author_id"]],
                                        $row["text"],
                                        $row["date"],
                                        $row["creation_date"]);
                
                $this->citations[$row["citation_id"]] = $citation;
        }
    
        $pdoStatement = null;
        $this->closeConnection($pdo);
    }

    function getAuthor($author_id) {
        return $this->authors[$author_id];
    }

    function fetchAuthors(): void {
        $pdo = $this->connectToDatabase();

        $sql = "SELECT a.author_id, a.surname, a.name, a.birth_date FROM Author as a;";
        $pdoStatement=$pdo->query($sql);
        $authors = array();
        
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $author = new Author($row["surname"],
                                $row["name"],                                        
                                $row["birth_date"]);
            $author->setId($row["author_id"]);
            $authors[$row["author_id"]] = $author;
        }
        $pdoStatement = null;
        $this->closeConnection($pdo);

        $this->authors = $authors; 
    }

    

    public function getCitationsCached() {
        return $this->citations;
    }

    public function getAuthorsCached() {
        return $this->authors;
    }

    private function isAuthorInDatabase(Author $author) {
        foreach ($this->authors as $key => $existingAuthor) {
            if ($author->equals($existingAuthor)) { 
                $author->setId($existingAuthor->getId());
                return true;
            }
        }
        return false;
    }
 
    private function isValidParameters(string $login,
                                       Author $author,
                                       string $text,
                                       string $date) {
        if (empty($login) || empty($text) || empty($author) || empty($date)) {
            return false;
        }

        $d = DateTime::createFromFormat('Y-m-d', $date); 
        $isValidDate = $d && $d->format('Y-m-d') == $date && $date <= Date("Y-m-d"); 

        return $isValidDate;
    }

    public function __toString() {
        $final = "";

        foreach ($this->citations as $key => $citation) {
            $final .= "{$citation->__toString()} <br>";
        }

        return $final;
    }

    function showCitations() {
        $visual = "";
        foreach ($this->citations as $key => $citation) {
            $visual.= $citation->__to_html();
        }
        return $visual;
    }

}

?>
