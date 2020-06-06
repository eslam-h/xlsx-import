<?php

namespace Dev\Application\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $acceptedRows = 0;

    public $rejectedRows = 0;

    /**
     * Create a new message instance.
     * @param int $acceptedRows
     * @param int $rejectedRows
     * @return void
     */
    public function __construct(int $acceptedRows, int $rejectedRows)
    {
        $this->acceptedRows = $acceptedRows;
        $this->rejectedRows = $rejectedRows;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env("MAIL_USERNAME"))->view('emails.import-succeeded');
    }
}
