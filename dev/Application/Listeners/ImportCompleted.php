<?php

namespace Dev\Application\Listeners;

use Dev\Application\Events\ImportCompleted AS ImportCompletedEvent;
use Illuminate\Support\Facades\Mail;
use Dev\Application\Mails\ImportCompleted AS ImportCompletedMail;

/**
 * Class ImportCompleted
 * @package Dev\Application\Listeners
 */
class ImportCompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImportCompletedEvent  $event
     * @return void
     */
    public function handle(ImportCompletedEvent $event)
    {
        Mail::to($event->sendToMail)->send(new ImportCompletedMail($event->acceptedRecords, $event->rejectedRecords));
    }
}
