<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class CreatePayment implements RequestInterface
{
    private Amount $amount;
    private ?Currency $currency;
    private ?Description $description;
    private ?Control $control;
    private ?Customer $customer;
    private ?Billing $billing;
    private ?Shipping $shipping;
    /**
     * @var CartItem[]
     */
    private array $cart;
    private ?CallbackReturnUrl $returns;
    private ?DirectChannel $directChannel;
    /**
     * @var Channel[]|null
     */
    private ?array $channels;
    private ?ChannelType $channelType;
    private ?Referer $referer;

    public function __construct(
        Amount $amount,
        array $cart,
        ?ChannelType $channelType = null,
        ?Currency $currency = null,
        ?Description $description = null,
        ?Control $control = null,
        ?Customer $customer = null,
        ?Billing $billing = null,
        ?Shipping $shipping = null,
        ?CallbackReturnUrl $returns = null,
        ?DirectChannel $directChannel = null,
        ?array $channels = null,
        ?Referer $referer = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->control = $control;
        $this->customer = $customer;
        $this->billing = $billing;
        $this->shipping = $shipping;
        $this->cart = $cart;
        $this->returns = $returns;
        $this->directChannel = $directChannel;
        $this->channels = $channels;
        $this->channelType = $channelType;
        $this->referer = $referer;
    }

    public function toArray(): array
    {
        $data = [];
        $data += $this->amount->toArray();

        if ([] !== $this->cart) {
            $data['cart'] = \array_map(static fn (CartItem $item): array => $item->toArray(), $this->cart);
        }

        if (null !== $this->currency) {
            $data += $this->currency->toArray();
        }

        if (null !== $this->description) {
            $data += $this->description->toArray();
        }

        if (null !== $this->control) {
            $data += $this->control->toArray();
        }

        if (null !== $this->customer) {
            $data += $this->customer->toArray();
        }

        if (null !== $this->billing) {
            $data += $this->billing->toArray();
        }

        if (null !== $this->shipping) {
            $data += $this->shipping->toArray();
        }

        if (null !== $this->returns) {
            $data += $this->returns->toArray();
        }

        if (null !== $this->directChannel) {
            $data += $this->directChannel->toArray();
        }

        if (null !== $this->channels) {
            $data['channels'] = \array_map(static fn (Channel $channel): string => (string)$channel, $this->channels);
        }

        if (null !== $this->channelType) {
            $data += $this->channelType->toArray();
        }

        if (null !== $this->referer) {
            $data += $this->referer->toArray();
        }

        return $data;
    }
}
