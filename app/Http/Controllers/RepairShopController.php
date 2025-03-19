<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RepairShopController extends Controller
{
    public function show()
    {
        // Load the Excel file
        $filePath = storage_path('app/public/Repair_Shop_Directory.xlsx');

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        return view('repair', compact('rows'));
    }
}
