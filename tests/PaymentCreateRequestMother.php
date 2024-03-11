<?php

declare(strict_types=1);

namespace Simpay\Test;

use Simpay\Model\Request\Amount;
use Simpay\Model\Request\Billing;
use Simpay\Model\Request\CallbackReturnUrl;
use Simpay\Model\Request\CartItem;
use Simpay\Model\Request\Channel;
use Simpay\Model\Request\ChannelType;
use Simpay\Model\Request\Control;
use Simpay\Model\Request\CreatePayment;
use Simpay\Model\Request\Currency;
use Simpay\Model\Request\Customer;
use Simpay\Model\Request\Description;
use Simpay\Model\Request\DirectChannel;
use Simpay\Model\Request\Referer;
use Simpay\Model\Request\Shipping;

class PaymentCreateRequestMother
{
    public static function create(array $data = []): CreatePayment
    {
        $defaults = \array_merge(self::getDefaults(), $data);

        return new CreatePayment(
            $defaults['amount'],
            $defaults['cart'],
            $defaults['channel_types'],
            $defaults['currency'],
            $defaults['description'],
            $defaults['control'],
            $defaults['customer'],
            $defaults['billing'],
            $defaults['shipping'],
            $defaults['returns'],
            $defaults['direct_channel'],
            $defaults['channels'],
            $defaults['referer'],
        );
    }

    private static function getDefaults(): array
    {
        return [
            'amount' => new Amount(23.23),
            'currency' => Currency::createDefault(),
            'description' => new Description('Default description'),
            'control' => new Control('Default control'),
            'customer' => new Customer('Default customer', 'jhondoe@example.com'),
            'billing' => new Billing(
                'billing name',
                'billing surname',
                'billing street',
                'billing building',
                'billing flat',
                'billing city',
                'billing region',
                'billing postcode',
                'billing country',
                'billing company',
            ),
            'shipping' => new Shipping(
                'shipping name',
                'shipping surname',
                'shipping street',
                'shipping building',
                'shipping flat',
                'shipping city',
                'shipping region',
                'shipping postcode',
                'shipping country',
                'shipping company',
            ),
            'cart' => [new CartItem('cart item name', 1, 20.00, 'producer', 'category', 'code',), ],
            'returns' => new CallbackReturnUrl('https://example.com/success', 'https://example.com/failure',),
            'direct_channel' => new DirectChannel('direct_channel'),
            'channels' => [new Channel('test_channel_id'), new Channel('test_channel_id_2')],
            'channel_types' => new ChannelType(true, true, true, true, true),
            'referer' => new Referer('https://example.com'),
        ];
    }
}
