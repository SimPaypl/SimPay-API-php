<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class ServiceCalculation
{
    public ?ServiceCalculationOperatorAmount $orange;
    public ?ServiceCalculationOperatorAmount $play;
    public ?ServiceCalculationOperatorAmount $tMobile;
    public ?ServiceCalculationOperatorAmount $plus;

    private function __construct(
        ?ServiceCalculationOperatorAmount $orange,
        ?ServiceCalculationOperatorAmount $play,
        ?ServiceCalculationOperatorAmount $tMobile,
        ?ServiceCalculationOperatorAmount $plus
    ) {
        $this->orange = $orange;
        $this->play = $play;
        $this->tMobile = $tMobile;
        $this->plus = $plus;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['orange'] ? ServiceCalculationOperatorAmount::createFromResponse($data['orange']) : null,
            $data['play'] ? ServiceCalculationOperatorAmount::createFromResponse($data['play']) : null,
            $data['t-mobile'] ? ServiceCalculationOperatorAmount::createFromResponse($data['t-mobile']) : null,
            $data['plus'] ? ServiceCalculationOperatorAmount::createFromResponse($data['plus']) : null,
        );
    }
}
