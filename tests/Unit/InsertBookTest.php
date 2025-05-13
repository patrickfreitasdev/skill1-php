<?php

use Library\Book;

test('insert book', function () {

    $bookInformation = [
        'name'      => 'PHP & MySQL: Server-side Web Development',
        'isbn'      => '1119149223',
        'publisher' => 'Wiley',
        'author'    => 'Jon Duckett',
    ];

    $startCount = 0;
    $file       = __DIR__ . '/../../storage/books.json';

    if (file_exists($file)) {
        $startCount = count(json_decode(file_get_contents($file), true));
    }

    $book = new Book();
    $book->addBook($bookInformation['name'], $bookInformation['isbn'], $bookInformation['publisher'], $bookInformation['author']);
    $book->saveBook();

    $newFile = json_decode(file_get_contents($file), true);

    expect($newFile)->toBeArray();
    expect($newFile)->toHaveLength($startCount + 1);

    unlink($file);

});
