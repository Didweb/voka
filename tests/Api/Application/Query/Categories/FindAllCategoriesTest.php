<?php

namespace App\Tests\Api\Application\Query\Categories;

use App\Tests\Api\Application\Response\Categories\CategoryCollectionResponseStub;
use App\Vokabular\Api\Application\Query\Categories\FindAllCategories;
use App\Vokabular\Api\Application\Query\Categories\FindAllCategoriesQuery;
use App\Vokabular\Api\Application\Response\Categories\CategoryCollectionResponse;
use App\Vokabular\Api\Domain\Model\Categories\CategoryRepository;
use Monolog\Test\TestCase;

class FindAllCategoriesTest extends TestCase
{
    private CategoryCollectionResponse $categories;
    private CategoryRepository $categoryRepository;
    protected function setUp(): void
    {
        $this->categories = CategoryCollectionResponseStub::listCatgories();

        $this->categoryRepository = $this->createMock(CategoryRepository::class);
        $this->categoryRepository->expects($this->any())
            ->method('findAll')
            ->willReturn($this->categories);

    }

    public function testFindAllCategories()
    {
        $findAllCategoriesQuery  = new FindAllCategories($this->categoryRepository);
        $findAllCategoriesQueryHandler = new FindAllCategoriesQuery();

        $result = $findAllCategoriesQuery->__invoke($findAllCategoriesQueryHandler);

        $this->assertEquals($result->categories()[0]->name(), 'Hause');
        $this->assertEquals($result->categories()[1]->name(), 'Büro');
        $this->assertEquals($result->categories()[2]->name(), 'Familie');
        $this->assertEquals($result->categories()[4]->name(), 'Köper');
    }

}