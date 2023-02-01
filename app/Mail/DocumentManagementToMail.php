<?php

namespace App\Mail;

use App\Models\DocumentManagement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentManagementToMail extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * The document instance.
     *
     * @var \App\Models\DocumentManagement
     */
    public $document;
 
    /**
     * Create a new message instance.
     *
     * @param  \App\Models\DocumentManagement  $document
     * @return void
     */
    public function __construct(DocumentManagement $document)
    {
        $this->document = $document;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.document-management');
    }
}
