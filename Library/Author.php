<?php
namespace Library;

class Author
{

    public $author_id;
    public $author_name;

    public function __construct($author_id, $author_name)
    {
        $this->author_id   = $author_id;
        $this->author_name = $author_name;
    }

    /**
     * Get the author item
     * @return array
     */
    public function getAuthorItem(): array
    {

        return [
            'author_id'   => $this->author_id,
            'author_name' => $this->author_name,
        ];

    }

}
