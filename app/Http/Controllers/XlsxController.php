<?php

namespace App\Http\Controllers;

use Dev\Application\FormRequests\ImportingXlsxFormRequest;
use Dev\Application\Service\ImportXlsxService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class XlsxController responsible for interacting with xlsx files
 * @package App\Http\Controllers
 */
class XlsxController extends BaseController
{
    private $importXlsxService;

    public function __construct(ImportXlsxService $importXlsxService)
    {
        $this->importXlsxService = $importXlsxService;
    }

    public function displayXlsxUploadForm()
    {
        return view("xlsx.form");
    }

    public function importXlsxFile(ImportingXlsxFormRequest $request)
    {
        $this->importXlsxService->importXlsxFile($request->validated());
        $request->session()->flash("import-succeeded", true);

        return redirect('/import-succeeded');
    }

    public function displayImportSucceededPage(Request $request)
    {
        if ($request->session()->pull('import-succeeded')) {
            return view("xlsx.import-succeeded");
        }
        abort(404);
    }
}