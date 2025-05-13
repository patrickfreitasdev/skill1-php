<?php

use Library\Book;

test('delete book', function () {

    $newBooks = [
        [
            'name'      => 'PHP & MySQL: Server-side Web Development',
            'isbn'      => '1119149223',
            'publisher' => 'Wiley',
            'author'    => 'Jon Duckett',
        ],
        [
            'name'      => 'PHP & MySQL: Server-side Web Development',
            'isbn'      => '0321125215',
            'publisher' => 'Addison-Wesley Professional',
            'author'    => 'Eric Evans ',
        ],
        [
            'name'      => 'The Intelligent Investor Third Edition',
            'isbn'      => '0060555661',
            'publisher' => 'Harper Business',
            'author'    => 'Benjamin Graham',
        ],
    ];

    $file = __DIR__ . '/../../storage/books.json';

    if (file_exists($file)) {
        unlink($file);
    }

    foreach ($newBooks as $bookItem) {
        $book = new Book();
        $book->addBook($bookItem['name'], $bookItem['isbn'], $bookItem['publisher'], $bookItem['author']);
        $book->saveBook();
    }

    $newFile = json_decode(file_get_contents($file), true);

    expect($newFile)->toBeArray();
    expect($newFile)->toHaveLength(count($newBooks));

    // get the first book id
    $firstBookId = $newFile[0]['resourceId'];

    $book = new Book();
    $book->deleteResourceById($firstBookId, 'books');

    // get the new file again
    $newFile = json_decode(file_get_contents($file), true);

    expect($newFile)->toBeArray();
    expect($newFile)->toHaveLength(count($newBooks) - 1);

    unlink($file);

});
