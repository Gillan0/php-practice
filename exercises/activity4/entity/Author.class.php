<?php 

use Datetime;


/**
 * This class represents an author and records its name,
 * surname, date of birth and a number of citations
 */
class Author  {

    /** Surname of the author */
    private string $surname;

    /** First name of the author */
    private string $name;

    /** Author's date of birth */
    private string $date;

    /** Author's id in database */
    private string $author_id;

    /** Author's recorded citations */
    private $citations=array();

    /**
     * Constructor of Author class
     * @param $surname Surname of the author
     * @param $name First name of the author
     * @param $date Author's birth date
     */
    function __construct(string $surname,
                         string $name,
                         string $date) {
        
        $this->surname = trim($surname);
        $this->name = trim($name);
        $this->date = trim($date);
    }

    public function setId(string $id) {
        $this->author_id = $id;
    }

    public function getId() {
        return $this->author_id;    
    }

    public function getSurname() {
        return $this->surname;    
    }
    public function getName() {
        return $this->name;
    }
    public function getDate() {
        return $this->date;
    }

    /**
     * Adds a citation of this Author
     * @param $c Citation of this author
     */
    public function addCitation(Citation $c) {
        if ($this->isCitationFromAuthor($c)) {
            array_push($this->citations, $c);
        }
    }

    /**
     * Checks if a citation is attributed to this
     * author
     * @param $c Citation to be evaluated
     * @return bool if the citation is from this author
     */
    private function isCitationFromAuthor(Citation $c) {
        return ($c->getAuthor() == $this);
    }

    /**
     * Returns a description of the author of format : 
     * name - surname | date of birth
     * @return string description of the author
     */
    public function __tostring() {
        return "{$this->surname} - {$this->name} | {$this->date}";
    }

    public function equals(Author $author) : bool {
        return trim($this->surname) == trim($author->surname) &&
               trim($this->name) == trim($author->name) &&
               trim($this->date) == trim($author->date);
    }

    public function isValidAuthor() {
        if (empty($this->surname) || empty($this->name) || empty($this->date)) {
            return false;
        }
        
        if (strlen($this->surname) > 100 || strlen($this->name) > 100) { 
            return false;
        }
        
        $d = DateTime::createFromFormat('Y-m-d', $this->date); 
        $isValidDate = $d && $d->format('Y-m-d') == $this->date && $this->date <= Date("Y-m-d"); 
        return $isValidDate;
    }

}

?>