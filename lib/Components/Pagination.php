<?php

namespace SimPay\API\Components;

class Pagination
{
    private object $pagination;

    public function __construct(object $pagination)
    {
        $this->pagination = $pagination;
    }

    public function getTotal(): ?int
    {
        if (!isset($this->pagination->total)) {
            return null;
        }

        return $this->pagination->total;
    }

    public function getCount(): ?int
    {
        if (!isset($this->pagination->count)) {
            return null;
        }

        return $this->pagination->count;
    }

    public function getPerPage(): ?int
    {
        if (!isset($this->pagination->per_page)) {
            return null;
        }

        return $this->pagination->per_page;
    }

    public function getCurrentPage(): ?int
    {
        if (!isset($this->pagination->current_page)) {
            return null;
        }

        return $this->pagination->current_page;
    }

    public function getTotalPages(): ?int
    {
        if (!isset($this->pagination->total_pages)) {
            return null;
        }

        return $this->pagination->total_pages;
    }

    public function hasNextPage(): ?bool
    {
        if (!isset($this->pagination->links)) {
            return null;
        }

        if (!isset($this->pagination->links->next_page)) {
            return null;
        }

        return null !== $this->pagination->links->next_page;
    }

    public function hasPrevPage(): ?bool
    {
        if (!isset($this->pagination->links)) {
            return null;
        }

        if (!isset($this->pagination->links->prev_page)) {
            return null;
        }

        return null !== $this->pagination->links->prev_page;
    }

    public function getObject(): object
    {
        return $this->pagination;
    }
}
