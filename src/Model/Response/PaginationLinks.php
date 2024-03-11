<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaginationLinks
{
    public ?string $nextPage;
    public ?string $previousPage;

    private function __construct(?string $nextPage, ?string $previousPage)
    {
        $this->nextPage = $nextPage;
        $this->previousPage = $previousPage;
    }

    public static function createFromResponse(array $links): self
    {
        return new self($links['next_page'] ?? null, $links['previous_page'] ?? null,);
    }
}
