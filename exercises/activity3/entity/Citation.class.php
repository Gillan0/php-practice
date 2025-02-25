<?php 


use Author;

/**
 * Represents a citation with its author, text, date and user who
 * added it to the database
 */
class Citation  {

    /** User who added this citation to the database */
    private string $login;
    
    /** Author of the citation */
    private Author $author;
    
    /** Text of the citation */
    private string $text;

    /** Date when this citation was told */
    private string $date;

    /**
     * Constructor of the Citation class
     */
    function __construct(string $login,
                        Author $author,
                        string $text,
                        string $date) {
        
        $this->login = $login;
        $this->author = $author;
        $this->text = $text;
        $this->date = $date;
    }

    /**
     * Return the author of the citation
     * @return Author of the citation
     */
    public function getAuthor() {
        return $this->author;
    }

    public function __toString() {
        return "{$this->login} sent the following citation : <br> \"{$this->text}\" - {$this->author} - {$this->date} <br>";
    }

    /**
     * Checks if represents the same citation as $citation
     * 
     * @param Citation $citation
     * @return bool
     */
    public function equals(Citation $citation): bool {
        return ($this->author->equals($citation->getAuthor()) && $this->text === $citation->text && $this->date === $citation->date);
    }

}

?>