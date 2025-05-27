<?php

/**
 * Class Library
 * @package Library
 *
 * This is the main class for the library system
 *
 */

namespace Library;

class Library
{

    private string $isRunning;
    private string $firstAccess;
    private string $userInput;

    public function __construct()
    {
        $this->firstAccess = true;
        $this->isRunning   = false;
    }

    /**
     * Init the library system, here we will keep the loop
     * running until exit is set to false (option 4 in the menu)
     */
    public function init(): void
    {
        $this->isRunning = true;

        while ($this->isRunning) {
            $this->userInput = $this->getUserInput();
            $this->handleMenuSelection();
        }
    }

    /**
     * Get the welcome message
     * @return string
     */
    private function getWelcomeMessage(): string
    {
        return "\n=============================\n
        Welcome to Maddington Library book management system \n
        Select one option below:";
    }

    /**
     * Get the menu
     * @return string
     */
    private function getMenu(): string
    {
        return "\n=============================\n
        1. Add a new book \n
        2. List all books \n
        3. Search for a book \n
        4. Sort books by name \n
        5. Delete a book \n
        6. Add resource \n
        7. List resources \n
        8. Search for a resource \n
        9. Delete a resource \n
        10. Exit
        \n=============================\n";
    }

    /**
     * Get the user input
     * @return int
     */
    private function getUserInput(): int
    {

        if ($this->firstAccess) {
            echo $this->getWelcomeMessage();
            $this->firstAccess = false;
        }

        return (int) readline($this->getMenu() . "Enter your choice: ");

    }

    /**
     * Handle the menu selection
     * @return void
     */
    private function handleMenuSelection(): void
    {

        switch ($this->userInput) {
            case 1:

                $book = new Book();

                $bookName      = readline("Enter the book name: ");
                $bookIsbn      = readline("Enter the book ISBN: ");
                $bookPublisher = readline("Enter the book publisher: ");
                $bookAuthor    = readline("Enter the book author: ");

                $book->addBook($bookName, $bookIsbn, $bookPublisher, $bookAuthor);
                $book->saveBook();

                break;

            case 2:

                $book = new Book();
                $book->listBooks();

                break;

            case 3:

                $book   = new Book();
                $bookId = readline("Enter the book id: ");
                $book->getBookById($bookId);

                break;

            case 4:

                $book = new Book();
                $book->sortBookByName();

                break;

            case 5:

                $book   = new Book();
                $bookId = readline("Enter the book id: ");
                $book->deleteResourceById($bookId, 'books');

                break;

            case 6:

                $category      = readline("Enter the resource category: ");
               

                $res_name        = readline("Enter the resource name: ");
                $res_description = readline("Enter the resource description: ");
                $res_brand       = readline("Enter the resource brand: ");

                $otherResource = new OtherResource($res_name, $res_description, $res_brand, $category);
                $otherResource->saveOtherResource();
           
                break;

            case 7:

                $otherResource = new OtherResource();
                $otherResource->listOtherResources();

                break;

            case 8:

                $otherResource   = new OtherResource();
                $otherResourceId = readline("Enter the resource id: ");
                $otherResource->getResourceById($otherResourceId);

                break;

            case 9:

                $otherResource   = new OtherResource();
                $otherResourceId = readline("Enter the resource id: ");
                $otherResource->deleteResourceById($otherResourceId, 'other_resources');
                break;

            case 10:

                $this->isRunning = false;

                break;

            default:
                echo "Invalid option, enter a number between 1 and 10";
                break;
        }
    }

}
