<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Bill;
use App\Models\Product;
class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
   
    /**
     * Create a new message instance.
     */
    public $bill;

    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'MM Mega Market',
        );
    }
    public function build()
    {
        $billDetails = $this->bill->billDetails; 

        $orderDetails = [];
        foreach ($billDetails as $detail) {
            $product = Product::find($detail->id_product);
            $price = $product->promotion_price != 0 ? $product->promotion_price : $product->unit_price;
            if ($product) {
                $orderDetails[] = [
                    'product_name' => $product->name, 
                    'quantity' => $detail->quantity,
                    'price' => $price, 
                ];
            }
        }

        return $this->markdown('emails.orders.placed')
                    ->subject('Xác nhận đơn hàng của bạn')
                    ->with([
                        'order_id' => $this->bill->id,
                        'order_total' => $this->bill->total,
                        'order_details' => $orderDetails,
                    ]);
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.placed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
