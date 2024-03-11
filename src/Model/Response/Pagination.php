<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class Pagination
{
    public int $total;
    public int $count;
    public int $perPage;
    public int $currentPage;
    public int $totalPages;
    public ?PaginationLinks $links;

    private function __construct(
        int $total,
        int $count,
        int $perPage,
        int $currentPage,
        int $totalPages,
        ?PaginationLinks $links
    ) {
        $this->total = $total;
        $this->count = $count;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->links = $links;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['total'],
            $data['count'],
            $data['per_page'],
            $data['current_page'],
            $data['total_pages'],
            PaginationLinks::createFromResponse($data['links']),
        );
    }
}
