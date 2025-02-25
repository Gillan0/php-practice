<?php

use \DateTime; 

/**
 * Stores all the data collected by the website
 */
class CitationDatabase {

    private $citations = array();
    private $authors = array();

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
                            
        if (!$this->isAuthorInDatabase($author)) {
            array_push($this->authors, $author);
        }
        
        $citation = new Citation($login, $author, $text, $date);
        array_push($this->citations, $citation);
        return;
    }

    public function getCitations() {
        return $this->citations;
    }

    public function getAuthors() {
        return $this->authors;
    }

    private function isAuthorInDatabase(Author $author) {
        foreach ($this->authors as $existingAuthor) {
            if ($existingAuthor == $author) { 
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

        foreach ($this->citations as $citation) {
            $final .= "{$citation->__toString()} <br>";
        }

        return $final;
    }

}

?>
