<?php

namespace simpay;

use simpay\Components;

class Directbilling extends Components
{
    private $error = false;
    private $errorCode = 0;

    private $serviceApi = '';
    private $apiKey = '';
    private $apiSecret = '';

    private $status = '';
    private $value = '';
    private $valueGross = '';
    private $control = '';

    private $transId = '';

    private $valuePartner = '';

    private $userNumber = '';

    protected $debugMode = false;
    
    public function __construct($serviceApi = '', $apiAuth = [null, null])
    {
        
        $this->serviceApi = $serviceApi;
        $this->apiKey = $apiAuth[0];
        $this->apiSecret = $apiAuth[1];
        
        $this->components = new Components();
    }

    public function setDebugMode($value)
    {
        $this->debugMode = (boolean)$value;
    }

    private function isDebugMode()
    {
        return !!$this->debugMode;
    }

    private function logDebugMode($err)
    {
        print_r($err);
        error_log($err);
    }

    public function parse($data)
    {

        if (!isset($data['id'])) {
            $this->setError(true, 1);

            if ($this->isDebugMode()) {
                $this->logDebugMode($this->getErrorText());
            }
            
            return false;
        }

        if (!isset($data['status'])) {
            $this->setError(true, 1);

            if ($this->isDebugMode()) {
                $this->logDebugMode($this->getErrorText());
            }
            
            return false;
        }
        
        if (!isset($data['valuenet'])) {
            $this->setError(true, 1);

            if ($this->isDebugMode()) {
                $this->logDebugMode($this->getErrorText());
            }
            
            return false;
        }

        if (!isset($data['sign'])) {
            $this->setError(true, 1);

            if ($this->isDebugMode()) {
                $this->logDebugMode($this->getErrorText());
            }

            return false;
        }

        $this->status = trim($data['status']);
        $this->value =  trim($data['valuenet']);
        $this->valueGross =  trim($data['valuenet_gross']);

        if (isset($data['control'])) {
            $this->control = trim($data['control']);
        }

        if (isset($data['number_from'])) {
            $this->userNumber = trim($data['number_from']);
        }

        $this->transId = trim($data['id']);

        $this->valuePartner = trim($data['valuepartner']);

        if (hash('sha256', $this->transId . $this->status . $this->value . $this->valuePartner . $this->control . $this->serviceApi) != $data['sign']) {
            $this->setError(true, 3);

            if ($this->isDebugMode()) {
                $this->logDebugMode($this->getErrorText());
            }
            
            return false;
        }

        $this->value = floatval(str_replace(',', '.', $this->value));

        if ($this->value <= 0.00) {
            $this->setError(true, 4);

            if ($this->isDebugMode()) {
                $this->logDebugMode($this->getErrorText());
            }
        }

        $this->valuePartner = floatval(str_replace(',', '.', $this->valuePartner));

        if ($this->valuePartner <= 0.00) {
            $this->setError(true, 4);

            if ($this->isDebugMode()) {
                $this->logDebugMode($this->getErrorText());
            }
        }

        return true;
    }
    
    public function isError()
    {
        return $this->error;
    }
    
    public function getErrorText()
    {
        switch ($this->errorCode) {
            case 0:
                return 'No Error';
            case 1:
                return 'Missing Parameters';
            case 2:
                return 'No Sign Param';
            case 3:
                return 'Wrong Sign';
            case 4:
                return 'Wrong Amount Value';
        }
        
        return '';
    }
    
    private function setError($state, $code)
    {
        $this->error = $state;
        $this->errorCode = $code;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getValueGross()
    {
        return $this->valueGross;
    }

    public function getControl()
    {
        return $this->control;
    }

    public function isTransactionPaid()
    {
        return ($this->status == 'ORDER_PAYED');
    }

    public function getTransactionId()
    {
        return $this->transId;
    }

    public function okTransaction()
    {
        ob_clean();
        echo 'OK';
    }

    public function getValuePartner()
    {
        return $this->valuePartner;
    }

    public function getUserNumber()
    {
        return $this->userNumber;
    }

    public function calculateRewardPartner($amount, $provider, $serviceId)
    {
        /*
        $provider =
        1 - Orange
        2 - Play
        3 - T-mobile
        4 - Plus
        */
        
        $result = $this->url('db_hosts_commission', array('service_id' => $serviceId));
        
        if (!isset($result->respond)) {
            return false;
        }

        if ($amount <= 0) {
            return 0.00;
        }

        $arrayCommission = [];

        switch ($provider) {
            case 1:
                $arrayCommission = [$result->respond[0]->commission_0, $result->respond[0]->commission_9, $result->respond[0]->commission_25];
                break;
            case 2:
                $arrayCommission = [$result->respond[1]->commission_0, $result->respond[1]->commission_9, $result->respond[1]->commission_25];
                break;
            case 3:
                $arrayCommission = [$result->respond[2]->commission_0, $result->respond[2]->commission_9, $result->respond[2]->commission_25];
                break;
            case 4:
                $arrayCommission = [$result->respond[3]->commission_0, $result->respond[3]->commission_9, $result->respond[3]->commission_25];
                break;
        }

        if ($amount < 9) {
            return number_format($amount * ($arrayCommission[0] / 100), 2, '.', '');
        } elseif ($amount < 25) {
            return number_format($amount * ($arrayCommission[1] / 100), 2, '.', '');
        } else {
            return number_format($amount * ($arrayCommission[2] / 100), 2, '.', '');
        }
    }
    
    public function providersMaxAmount(int $serviceId, int $provider)
    {
        
        $this->response = $this->url('db_hosts', ['service_id' => $serviceId]);
        
        switch ($provider) {
            case 0:
                $amount = $this->response->respond;
                break;
            case 1:
                $amount = $this->response->respond[0];
                break;
            case 2:
                $amount = $this->response->respond[1];
                break;
            case 3:
                $amount = $this->response->respond[2];
                break;
            case 4:
                $amount = $this->response->respond[3];
                break;
        }
        
        return $amount;
    }
    
    public function getServices()
    {
        $this->response = $this->url('get_services_db');
        return $this->response;
    }
    
    public function getTransactions(int $serviceId, int $amount = 10, int $offset = 10)
    {
        $this->response = $this->url('transactions_db', ['service_id' => $serviceId, 'amount' => $amount, 'offset' => $offset]);
        return $this->response;
    }
    
    public function getTransaction(int $id)
    {
        $this->response = $this->url('db_status', ['id' => $id]);
        return $this->response;
    }
    
    public function response()
    {
        return $this->response;
    }
    
    private function url($value, $params = array())
    {
        $auth = array(
            "auth" => array(
                "key" => $this->apiKey,
                "secret" => $this->apiSecret,
            )
        );
        $data = json_encode(array('params' => array_merge($auth, $params)));
        $this->call = $this->components->request($data, "https://simpay.pl/api/" . $value, 'body');
        return $this->call;
    }
}
