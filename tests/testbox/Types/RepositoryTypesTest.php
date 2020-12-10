<?php declare(strict_types = 1);

namespace NextrasTests\OrmPhpStan\Types;

use Nextras\Orm\Entity\IEntity;


class RepositoryTypesTest
{
	public function testError(AuthorsRepository $repository, BooksRepository $booksRepository): void
	{
		$this->takeAuthor($repository->getById(1));
		$this->takeAuthor($repository->getBy([]));

		/** @var IEntity $a */
		$a = $repository->getById(1);
		$this->takeAuthor($booksRepository->persist($a));
	}


	public function testOk(AuthorsRepository $repository): void
	{
		$this->takeAuthor($repository->getByIdChecked(1));
		$this->takeAuthor($repository->getByChecked(['id' => 1]));
		$this->takeAuthorNullable($repository->getById(1));
		$this->takeAuthorNullable($repository->getBy([]));
		$this->takeAuthorNullable($repository->findAll()->fetch());
		$this->takeAuthorNullable($repository->findBy([])->getById(1));
		$this->takeAuthorNullable($repository->findBy([])->orderBy([])->limitBy(2, 0)->getById(1));
		$this->takeAuthorArray($repository->findAll()->fetchAll());

		/** @var IEntity $a */
		$a = $repository->getById(1);
		$this->takeAuthor($repository->persist($a));
		
		
		/** @var AuthorsRepository|BooksRepository $someRepo */
		$someRepo = $repository;
		foreach ($someRepo->findAll() as $ent) {
		
		}
	}


	private function takeAuthor(Author $author): void
	{
	}


	private function takeAuthorNullable(?Author $author): void
	{
	}


	/**
	 * @param array<int, Author> $authors
	 */
	private function takeAuthorArray($authors): void
	{
	}
}
