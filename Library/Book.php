<?php

/**
 * Class Book
 * @package Library
 *
 * This is the Book class for the library system
 *
 */

namespace Library;

use Library\LibraryResource;

class Book extends LibraryResource
{

    private string $name;
    private string $isbn;
    private string $publisher;
    private Author $author;

    /**
     *
     * We can hardcode the books category here, but in future we could have it dynamic to accept other types example magazines, etc.
     **/

    public function __construct()
    {
        parent::__construct("books");
    }

    /**
     * Add a book to the library
     * @param string $name
     * @param string $isbn
     * @param string $publisher
     * @param string $author
     */
    public function addBook(string $name, string $isbn, string $publisher, string $author): void
    {
        $this->name      = $name;
        $this->isbn      = $isbn;
        $this->publisher = $publisher;
        $this->author    = new Author(parent::generateUniqueId(), $author);
    }

    /**
     * Get the book item
     * @return array
     */
    public function getBookItem(): array
    {
        return [
            'name'      => $this->name,
            'isbn'      => $this->isbn,
            'publisher' => $this->publisher,
            'author'    => [
                'authorId' => $this->author->author_id,
                'name'     => $this->author->author_name,
            ],
        ];
    }

    /**
     * Save the book to the JSON file
     */
    public function saveBook(): void
    {
        parent::saveResourceInJSON('books', $this->getBookItem());
    }

    /**
     * List all the books from the JSON file
     */
    public function listBooks($books = []): void
    {
        if (empty($books)) {
            $books = parent::getFileContentByFileName('books');
        }

        if (empty($books)) {
            echo "No books found";
            return;
        }

        foreach ($books as $book) {
            echo "\n----------------------------------------\n";
            echo "Book ID: " . $book['resourceId'] . "\n";
            echo "Book Name: " . $book['name'] . "\n";
            echo "Book ISBN: " . $book['isbn'] . "\n";
            echo "Book Publisher: " . $book['publisher'] . "\n";
            echo "Book Author ID: " . $book['author']['authorId'] . "\n";
            echo "Book Author: " . $book['author']['name'] . "\n";
            echo "----------------------------------------\n";
        }
    }

    /**
     * Get the book by the id and print out the book details
     * @param string $id
     * @return void
     */
    public function getBookById(string $id): void
    {

        $books = parent::getFileContentByFileName('books');
        $key   = parent::locateKeyById($id);

        // Array search retruns the index,
        // so we need to validate the type too otherwise index 0 would be considered a false in PHP
        if ($key !== false) {
            echo "\n----------------------------------------\n";
            echo "Book ID: " . $books[$key]['resourceId'] . "\n";
            echo "Book Name: " . $books[$key]['name'] . "\n";
            echo "Book ISBN: " . $books[$key]['isbn'] . "\n";
            echo "Book Publisher: " . $books[$key]['publisher'] . "\n";
            echo "Book Author ID: " . $books[$key]['author']['authorId'] . "\n";
            echo "Book Author: " . $books[$key]['author']['name'] . "\n";
            echo "\n----------------------------------------\n";
        } else {
            echo "\n----------------------------------------\n";
            echo "Book not found";
            echo "\n----------------------------------------\n";
        }
    }

    /**
     * Sort the books by name, using usort https://dev.to/gbhorwood/php-powerful-sorting-with-usort-2fml
     * @return void
     *
     */
    public function sortBookByName(): void
    {
        $books = parent::getFileContentByFileName('books');

        if (empty($books)) {
            echo "No books to sort.\n";
            return;
        }

        usort($books, function ($a, $b) {
            return strcasecmp($a['name'], $b['name']);
        });

        $this->listBooks($books);
    }

}
