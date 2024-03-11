<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class SmsServiceCollection
{
    /**
     * @var SmsService[]
     */
    public array $data;
    public Pagination $pagination;

    public function __construct(
        array $data,
        Pagination $pagination
    ) {
        $this->data = $data;
        $this->pagination = $pagination;
    }
}
