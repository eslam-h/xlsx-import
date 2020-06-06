<?php

namespace Dev\Application\Service;

use Dev\Application\Jobs\XlsxImportJob;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ImportXlsxService responsible for importing xlsx file
 * @package Dev\Application\Service
 */
class ImportXlsxService
{
    /**
     * Import xlsx file service
     * @param array $data
     * @return \Maatwebsite\Excel\Excel
     */
    public function importXlsxFile(array $data)
    {
        return Excel::import(new XlsxImportJob($data["email"]), $data["xlsx"]);
    }
}