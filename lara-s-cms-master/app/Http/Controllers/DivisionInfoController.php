<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\system\SysBranch;
use App\Models\system\SysDepartment;
use App\Models\system\SysUnit;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DivisionInfoController extends Controller
{
    //

    public function get_data(Request $request)
    {
        $div_type = (int) $request->input('div_type');
        // dd("hapi hapi hapi = " . $div);

        if($div_type == 1){
            $data = $this->getBranches();
        }
        else if($div_type == 2){
            $data = $this->getDepartments();
        }
        else if($div_type == 3){
            $data = $this->getUnits();
        }
        else if($div_type == 4){
            $data = $this->getSubBranches();
        }

        // dd($data);

        // SUCCESS
        $response = [
            'status' => 'true',
            'message' => 'Successfully get data list',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    private function getBranches(){
        $data = SysBranch::select(
            'sys_branches.name as name',
            'sys_branches.location as location',
            'sys_branches.phone as phone',
        )
        ->get();

        return $data;
    }
    private function getDepartments(){
        $data = SysDepartment::select(
            'sys_departments.name as name',
            'sys_departments.location as location',
            'sys_departments.phone as phone',
        )
        ->get();
        return $data;
    }
    private function getUnits(){
        $data = SysUnit::select(
            'sys_units.name as name',
            'sys_units.location as location',
            'sys_units.phone as phone',
        )
        ->get();
        return $data;
    }

    private function getSubBranches(){
        $data = SysBranch::select(
            'sys_branches.name as name',
            'sys_branches.location as location',
            'sys_branches.phone as phone',
        )
        ->where('sys_branches.parent_id', '!=', 0)
        ->get();
        return $data;
    }

    public function download_data(Request $request)
    {
        $office = (int) $request->input('office');
        // dd($office);
        if($office == 1){
            $data = $this->getBranches();
        }
        else if($office == 2){
            $data = $this->getDepartments();
        }
        else if($office == 3){
            $data = $this->getUnits();
        }
        else if($office == 4){
            $data = $this->getSubBranches();
        }

        // $data = $data->toArray();

        // Create a new instance of the Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Location');
        $sheet->setCellValue('C1', 'Phone');

        // Populate the data starting from row 2
        $row = 2;
        foreach ($data as $employee) {

            $sheet->setCellValue('A' . $row, $employee->name?$employee->name:"-");
            $sheet->setCellValue('B' . $row, $employee->location?$employee->location:"-");
            $sheet->setCellValue('C' . $row,  $employee->mobile?$employee->mobile:"-");
            $row++;
        }


        // Create a new instance of the Xlsx writer
        $writer = new Xlsx($spreadsheet);

        // Set the output file path
        if($office==1){
            $filePath = storage_path('branch_info.xlsx');
        }
        else if($office==2){
            $filePath = storage_path('department_info.xlsx');
        }
        else if($office==3){
            $filePath = storage_path('unit_info.xlsx');
        }
        else if($office==4){
            $filePath = storage_path('subBranch_info.xlsx');
        }

        // Save the Excel file
        $writer->save($filePath);
        // dd("yes");
        return response()->download($filePath);

}
}
