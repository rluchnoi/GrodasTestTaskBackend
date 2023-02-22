<?php

namespace App\Http\Services\Payment;

use App\Models\Order;

/**
 * Payment Data Transfer Object
 */
class PaymentDTO 
{
    /**
     * Constructor
     */
    public function __construct(
        private string $cardNumber,
        private string $cardExpirationDate,
        private string $cardCVV,
        private Order $order,
    ) {}

    /**
     * Set order
     */
    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Set Card Number
     */
    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Set Card Expiration Date
     */
    public function setCardExpirationDate(string $cardExpirationDate): self
    {
        $this->cardExpirationDate = $cardExpirationDate;

        return $this;
    }

    /**
     * Set Card CVV
     */
    public function setCardCVV(string $cardCVV): self
    {
        $this->cardCVV = $cardCVV;

        return $this;
    }

    /**
     * Get Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * Get Card Number
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * Get Card Expiration Date
     */
    public function getCardExpirationDate(): string
    {
        return $this->cardExpirationDate;
    }

    /**
     * Get Card CVV
     */
    public function getCardCVV(): string
    {
        return $this->cardCVV;
    }
}
