<?php

namespace Dev\Application\Jobs;

use Dev\Application\Events\ImportCompleted;
use Dev\Infrastructure\Models\Citizen;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

/**
 * Class CitizensImport responsible for importing xlsx citizens related sheets
 * @package Dev\Infrastructure\XlsxImports
 */
class XlsxImportJob implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue, WithEvents,
    SkipsOnFailure
{
    use Importable, RegistersEventListeners;
    use Dispatchable, InteractsWithQueue, Queueable;

    public $acceptedRecords = 0;

    public $rejectedRecords = 0;

    public $sendToMail = '';

    public function __construct(String $sendToMail)
    {
        $this->sendToMail = $sendToMail;
    }

    /**
     * @param array $row
     *
     * @return Citizen|null
     */
    public function model(array $row)
    {
        $this->acceptedRecords++;

        return new Citizen([
            'first_name'  => $row["first_name"],
            'second_name' => $row["second_name"],
            'family_name' => $row["family_name"],
            'uid'         => $row["uid"],
        ]);
    }

    public function rules(): array
    {
        return [
            "first_name" => "required",
            "second_name" => "required",
            "family_name" => "required",
            "uid" => "required"
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        $this->rejectedRecords++;
    }

    public static function afterImport(AfterImport $event)
    {
        $xlsxImportJob = $event->getConcernable();
        if (!empty($xlsxImportJob->sendToMail)) {
            event(new ImportCompleted($xlsxImportJob));
        }
        Log::debug("File Imported Successfully");
    }
}