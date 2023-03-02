<?php

namespace SimPay\API\DirectBilling;

use JsonException;
use SimPay\API\DirectBilling\Exceptions\NotificationException;

class Notification
{
    private string $hashKey;

    /**
     * @var array<string,mixed>
     **/
    private array $data;

    /**
     * @param string|null $payload
     *
     * @throws NotificationException
     * @throws JsonException
     */
    public function __construct(string $hashKey, $payload = null)
    {
        $this->hashKey = $hashKey;

        $this->validate($payload);
    }

    /**
     * @param string|null $payload
     *
     * @throws NotificationException
     * @throws JsonException
     */
    private function validate($payload = null): void
    {
        if (!$payload) {
            throw new NotificationException('No payload found');
        }

        try {
            $this->data = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new NotificationException('Couldn\'t parse data');
        }

        if ($this->signature($this->data) !== $this->data['signature']) {
            throw new NotificationException('Bad signature');
        }
    }

    /**
     * @param array<string,mixed> $data
     *
     * @throws NotificationException
     */
    private function signature(array $data): string
    {
        if (!isset($data['signature'])) {
            throw new NotificationException('Signature param not found');
        }

        $array = [];

        $array[] = $data['id'];
        $array[] = $data['service_id'];
        $array[] = $data['status'];
        $array[] = $data['values']['net'];
        $array[] = $data['values']['gross'];
        $array[] = $data['values']['partner'];

        if (isset($data['returns']['complete'])) {
            $array[] = $data['returns']['complete'];
        }

        if (isset($data['returns']['failure'])) {
            $array[] = $data['returns']['failure'];
        }

        if (isset($data['control'])) {
            $array[] = $data['control'];
        }

        if (isset($data['number_from'])) {
            $array[] = $data['number_from'];
        }

        if (isset($data['provider'])) {
            $array[] = $data['provider'];
        }

        $array[] = $this->hashKey;
        $signature = implode('|', $array);

        return hash('sha256', $signature);
    }

    public function getId(): string
    {
        return $this->data['id'];
    }

    public function getServiceId(): int
    {
        return $this->data['service_id'];
    }

    public function getStatus(): string
    {
        return $this->data['status'];
    }

    public function getValueNet(): float
    {
        return $this->data['values']['net'];
    }

    public function getValueGross(): float
    {
        return $this->data['values']['gross'];
    }

    public function getValuePartner(): float
    {
        return $this->data['values']['partner'];
    }

    /**
     * @return mixed
     */
    public function getReturnSuccess()
    {
        return $this->data['returns']['complete'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getReturnFailure()
    {
        return $this->data['returns']['failure'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getControl()
    {
        return $this->data['control'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getNumberFrom()
    {
        return $this->data['number_from'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->data['provider'] ?? null;
    }

    /**
     * @return array<string,mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function isPaid(): bool
    {
        return 'transaction_db_payed' === $this->data['status'];
    }

    public function responseOk(): void
    {
        http_response_code(200);
        header('Content-Type: plain/text');
        exit('OK');
    }
}
