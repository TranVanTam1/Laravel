<?php

namespace App\Models;

class Cart
{
    public $items = null; // Holds the items in the cart
    public $totalQty = 0; // Total quantity of items in the cart
    public $totalPrice = 0; // Total price of all items in the cart

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /**
     * Add a single item to the cart.
     *
     * @param $item The item to be added
     * @param $id   Identifier for the item
     */
    public function add($item, $id)
    {
        $mathang = [
            'qty' => 0,
            'price' => $item->promotion_price == 0 ? $item->unit_price : $item->promotion_price,
            'item' => $item,
        ];

        if ($this->items && array_key_exists($id, $this->items)) {
            $mathang = $this->items[$id];
        }

        $mathang['qty']++;
        $mathang['price'] = ($item->promotion_price == 0 ? $item->unit_price : $item->promotion_price) * $mathang['qty'];

        $this->items[$id] = $mathang;
        $this->totalQty++;
        $this->totalPrice += ($item->promotion_price == 0 ? $item->unit_price : $item->promotion_price);
    }

    /**
     * Add many items of the same type to the cart.
     *
     * @param $item     The item to be added
     * @param $id       Identifier for the item
     * @param $soluong  Quantity of items to add
     */
    public function addMany($item, $id, $soluong)
    {
        $mathang = [
            'qty' => 0,
            'price' => $item->promotion_price == 0 ? $item->unit_price : $item->promotion_price,
            'item' => $item,
        ];

        if ($this->items && array_key_exists($id, $this->items)) {
            $mathang = $this->items[$id];
        }

        $mathang['qty'] += $soluong;
        $mathang['price'] = ($item->promotion_price == 0 ? $item->unit_price : $item->promotion_price) * $mathang['qty'];

        $this->items[$id] = $mathang;
        $this->totalQty += $soluong;
        $this->totalPrice += ($item->promotion_price == 0 ? $item->unit_price : $item->promotion_price) * $soluong;
    }

    /**
     * Reduce the quantity of a specific item in the cart by one.
     *
     * @param $id Identifier for the item
     */
    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']->promotion_price == 0 ? $this->items[$id]['item']->unit_price : $this->items[$id]['item']->promotion_price;

        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']->promotion_price == 0 ? $this->items[$id]['item']->unit_price : $this->items[$id]['item']->promotion_price;

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    /**
     * Remove an item completely from the cart.
     *
     * @param $id Identifier for the item
     */
    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

    /**
     * Update the quantity of a specific item in the cart.
     *
     * @param $id           Identifier for the item
     * @param $newQuantity  New quantity to update to
     */
    public function updateQuantity($id, $newQuantity)
    {
        if (array_key_exists($id, $this->items)) {
            $item = $this->items[$id];
            $oldQty = $item['qty'];
            $pricePerItem = $item['item']->promotion_price == 0 ? $item['item']->unit_price : $item['item']->promotion_price;

            // Update total quantity and total price
            $this->totalQty += ($newQuantity - $oldQty);
            $this->totalPrice += ($newQuantity - $oldQty) * $pricePerItem;

            // Update item quantity and price
            $item['qty'] = $newQuantity;
            $item['price'] = $newQuantity * $pricePerItem;

            $this->items[$id] = $item;
        }
    }

    /**
     * Update quantities of multiple items in the cart.
     *
     * @param $items Array containing item IDs as keys and new quantities as values
     */
    public function updateManyQuantities($items)
    {
        foreach ($items as $id => $newQuantity) {
            if (array_key_exists($id, $this->items)) {
                $item = $this->items[$id];
                $oldQty = $item['qty'];
                $pricePerItem = $item['item']->promotion_price == 0 ? $item['item']->unit_price : $item['item']->promotion_price;

                // Update total quantity and total price
                $this->totalQty += ($newQuantity - $oldQty);
                $this->totalPrice += ($newQuantity - $oldQty) * $pricePerItem;

                // Update item quantity and price
                $item['qty'] = $newQuantity;
                $item['price'] = $newQuantity * $pricePerItem;

                $this->items[$id] = $item;
            }
        }
    }

    /**
     * Calculate and return subtotal of the cart.
     *
     * @return float Subtotal of the cart
     */
    public function subtotal()
    {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $item['price'];
        }
        return $subtotal;
    }

    /**
     * Calculate and return total price of the cart.
     *
     * @return float Total price of the cart
     */
    public function total()
    {
        return $this->subtotal(); // In a real scenario, you might add shipping costs, taxes, etc.
    }
}
