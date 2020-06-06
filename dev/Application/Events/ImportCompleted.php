<?php

namespace Dev\Application\Events;

use Dev\Application\Jobs\XlsxImportJob;
use Illuminate\Foundation\Events\Dispatchable;

class ImportCompleted
{
    use Dispatchable;

    public $acceptedRecords = 0;

    public $rejectedRecords = 0;

    public $sendToMail = '';

    /**
     * Create a new event instance.
     * @param XlsxImportJob $xlsxImportJob
     * @return void
     */
    public function __construct(XlsxImportJob $xlsxImportJob)
    {
        $this->acceptedRecords = $xlsxImportJob->acceptedRecords;
        $this->rejectedRecords = $xlsxImportJob->rejectedRecords;
        $this->sendToMail = $xlsxImportJob->sendToMail;
    }
}
