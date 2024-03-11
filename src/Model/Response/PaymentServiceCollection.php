<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentServiceCollection
{
    /**
     * @var PaymentService[]
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
