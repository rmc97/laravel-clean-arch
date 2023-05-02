<?php

namespace Tests\MiniLeanpub\Unit\Application\UseCases\Book\CreateBook;

use App\Models\Book;
use PHPUnit\Framework\TestCase;
use MiniLeanpub\Infrastructure\Repository\Book\BookEloquentRepository;
use MiniLeanpub\Application\UseCases\Book\CreateBook\CreateBookUseCase;
use MiniLeanpub\Application\UseCases\Book\CreateBook\DTO\{BookCreateInputDTO, BookCreateOutputDTO};

class CreateBookUseCaseTest extends TestCase
{
    public function testShouldCreateANewBookViaUseCase(): void
    {
        $repository = $this->getRepositoryMock();

        $input = new BookCreateInputDTO(
            '5c353727-bdd1-4c00-aacf-e0a754cb6f33',
            'My Awesome Book',
            'My Awesome Book',
            25.9,
            'book_path',
            'text/markdown'
        );

        $useCase = new CreateBookUseCase($input, $repository);

        $result = $useCase->handle();

        $this->assertInstanceOf(BookCreateOutputDTO::class, $result);

        $data = $result->getData();

        $this->assertEquals('5c353727-bdd1-4c00-aacf-e0a754cb6f33', $data['bookCode']);

        $this->assertEquals('My Awesome Book', $data['title']);
    }

    /**
     * @return BookEloquentRepository
     */
    private function getRepositoryMock()
    {
        $return = new \stdClass();

        $return->bookCode = '5c353727-bdd1-4c00-aacf-e0a754cb6f33';

        $return->title = 'My Awesome Book';

        $return->description = 'My Awesome Book';

        $return->price = 25.9;

        $return->book_path = 'book_path';

        $model = $this->createMock(Book::class); // Eloquent Book Model...

        $mock = $this->getMockBuilder(BookEloquentRepository::class)
            ->onlyMethods(['create'])
            ->setConstructorArgs([$model])
            ->getMock();

        $mock->expects($this->once())
            ->method('create')
            ->willReturn($return);

        return $mock;
    }
}

?>
