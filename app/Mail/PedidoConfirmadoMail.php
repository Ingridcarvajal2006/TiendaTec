<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoConfirmadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;
    protected $pdfContent;

    /**
     * Create a new message instance.
     */
    public function __construct($pedido, $pdfContent)
    {
        $this->pedido = $pedido;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Pedido - ExtremeTech',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido_confirmado',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, 'Recibo_Pedido_' . $this->pedido->numero_seguimiento . '.pdf')
                    ->withMime('application/pdf'),
        ];
    }
}
