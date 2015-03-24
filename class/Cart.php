<?php

class Cart {

    function __construct() {
        $this->items = array();

        if (!empty($_SESSION['cart']['items']))
            $this->items = unserialize($_SESSION['cart']['items']);
    }

    function __destruct() {
        $_SESSION['cart']['items'] = serialize($this->getItems());
    }

    /**
     * @return CartItem[]
     */
    public function getItems () {
        return $this->items;
    }

    /**
     * @param CartItem $item
     *
     * If same article is added to cart before it will increase a count of articles
     * in the cart by number of articles added
     *
     */
    public function addItem ($item) {
        foreach ($this->items as $cartItem) {
            if ($cartItem->getProduct()->getId() == $item->getProduct()->getId()) {
                $cartItem->setCount($cartItem->getCount()+$cartItem->getCount());
                return;
            }
        }

        $this->items[] = $item;
    }

    public function clearCart() {
        $this->items = array();
    }

    /**
     * @return float
     *
     * Will return simple total of items added in cart. Simple in terms that it is
     * possible to add articles in multiple currencies in cart.
     *
     * It would be needed to make some kind of conversion chart to determine common
     * price
     *
     */
    public function getTotal() {
        $total = 0;
        foreach ($this->items as $cartItem) {
            $total += $cartItem->getProduct()->getPrice()*$cartItem->getCount();
        }
        return $total;
    }

    /**
     * @return string
     */
    public function getReadableTotal() {
        return number_format($this->getTotal(),2,',','.');
    }

    /**
     * @var CartItem[]
     */
    private $items;
}