<?php

namespace App\Vokabular\Api\Domain\Service;


class Pagination
{
    private int $page;
    private int $limit;
    private int $offset;
    private int $totalItems;
    private int $totalPages;

    public function __construct(int $page = 1, int $limit = 10)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->totalItems = 0;
        $this->totalPages = 0;

        $this->offset = $limit * ($page - 1);
    }

    public function page(): int
    {
        return $this->page;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public function offset(): int
    {
        return $this->offset;
    }

    public function totalItems(): int
    {
        return $this->totalItems;
    }

    public function totalPages(): int
    {
        return $this->totalPages;
    }

    public function updateTotals(int $totalItems): void
    {
        $this->totalItems = $totalItems;

        $this->totalPages = round($totalItems / $this->limit());
    }

    public function toArray(): array
    {
        return [
            'page' => $this->page(),
            'limit' => $this->limit(),
            'offset' => $this->offset(),
            'totalItems' => $this->totalItems(),
            'totalPages' => $this->totalPages(),
        ];
    }

}