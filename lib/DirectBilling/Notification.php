<?php

namespace SimPay\API\DirectBilling;

use JsonException;
use SimPay\API\DirectBilling\Exceptions\NotificationException;

class Notification
{

    private string $hashKey;

    private array $data;

    /**
     * @throws NotificationException
     * @throws JsonException
     */
    public function __construct(string $hashKey, $payload = null) {

        $this->hashKey = $hashKey;

        $this->validate($payload);

        return $this;

    }

    /**
     * @throws NotificationException
     * @throws JsonException
     */
    private function validate($payload = null) {

        if (!$payload) {
            throw new NotificationException('No payload found');
        }

        $data = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
        $this->data = $data;

        if ($this->signature($data) !== $data['signature']) {
            throw new NotificationException('Bad signature');
        }

    }

    /**
     * @throws NotificationException
     */
    private function signature(array $data) {

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

    public function getId() {
        return $this->data['id'];
    }

    public function getServiceId() {
        return $this->data['service_id'];
    }

    public function getStatus() {
        return $this->data['status'];
    }

    public function getValueNet() {
        return $this->data['values']['net'];
    }

    public function getValueGross() {
        return $this->data['values']['gross'];
    }

    public function getValuePartner() {
        return $this->data['values']['partner'];
    }

    public function getReturnSuccess() {
        return $this->data['returns']['complete'] ?? null;
    }

    public function getReturnFailure() {
        return $this->data['returns']['failure'] ?? null;
    }

    public function getControl() {
        return $this->data['control'] ?? null;
    }

    public function getNumberFrom() {
        return $this->data['number_from'] ?? null;
    }

    public function getProvider() {
        return $this->data['provider'] ?? null;
    }

    public function getData(): array {
        return $this->data;
    }

    public function isPaid(): bool {
        return $this->data['status'] === 'transaction_db_payed';
    }

    public function responseOk() {
        http_response_code(200);
        header('Content-Type: plain/text');
        exit('OK');
    }

}