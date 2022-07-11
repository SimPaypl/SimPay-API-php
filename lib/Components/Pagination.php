<?php

namespace SimPay\API\Components;

class Pagination
{

    private object $pagination;

    public function __construct(object $pagination)
    {
        $this->pagination = $pagination;
        return $this;
    }

    public function getTotal(): int
    {
        return $this->pagination->total;
    }

    public function getCount(): int
    {
        return $this->pagination->count;
    }

    public function getPerPage(): int
    {
        return $this->pagination->per_page;
    }

    public function getCurrentPage(): int
    {
        return $this->pagination->current_page;
    }

    public function getTotalPages(): int
    {
        return $this->pagination->total_pages;
    }

    public function hasNextPage(): bool
    {
        return $this->pagination->links->next_page !== null;
    }

    public function hasPrevPage(): bool
    {
        return $this->pagination->links->prev_page !== null;
    }

    public function getObject(): object
    {
        return $this->pagination;
    }

}