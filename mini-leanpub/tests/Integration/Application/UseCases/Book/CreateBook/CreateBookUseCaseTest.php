<?php

namespace Tests\MiniLeanpub\Integration\Application\UseCases\Book\CreateBook;

use App\Models\Book;
use Tests\MiniLeanpub\LaravelTestCase;
use MiniLeanpub\Infrastructure\Repository\Book\BookEloquentRepository;
use MiniLeanpub\Application\UseCases\Book\CreateBook\CreateBookUseCase;
use MiniLeanpub\Application\UseCases\Book\CreateBook\DTO\BookCreateInputDTO;

class CreateBookUseCaseTest extends LaravelTestCase
{
    public function testCreateARealBookViaUseCase()
    {
        $repository = new BookEloquentRepository(new Book());

        $input = new BookCreateInputDTO(
            '188e831e-0335-4bc9-9deb-c4d6dba6b258',
            'My Awesome Book',
            'My Awesome Book',
            25.9,
            'book_path',
            'text/markdown'
        );

        $useCase = new CreateBookUseCase($input, $repository);

        $result = $useCase->handle();

        $inputData =  $input->getData();

        $outputData = $result->getData();

        $this->assertEquals($inputData['bookCode'], $outputData['bookCode']);

        $this->assertEquals($inputData['title'], $outputData['title']);

        $this->assertEquals($inputData['price'], $outputData['price']);
    }
}

?>
