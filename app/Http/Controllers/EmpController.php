<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmpController extends Controller
{
    public function index()
    {
        return view('listing');
    }
    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids');
    Employee::whereIn('id', $ids)->delete();
    return response()->json(['success' => 'Records deleted successfully']);
}

    public function getEmployee(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn =  '<a data-id="'.$row->id.'" data-name="'.$row->name.'" data-email="'.$row->email.'" data-age="'.$row->age.'" data-salary="'.$row->salary.'"   class="edit btn btn-primary text-white rounded-square btn-sm">Edit</a> <button class="delete btn btn-danger btn-sm" data-id="'.$row->id.'" >Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('emp.listing');
    }

    public function destroy($id)
    {
        try {
            Employee::destroy($id);
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error deleting record: '. $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $employee = new Employee();
            $employee->name = $input['name'];
            $employee->email = $input['email'];
            $employee->age = $input['age'];
            $employee->salary = $input['salary'];
            $employee->save();
            return response()->json(['success' => 'Employee Added successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error Adding record: '. $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        //  dd($request->all());
        try {
         
            $input = $request->input();
            unset($input['_token']);
        Employee::where('id',$request->id)->update($input);
            return response()->json(['success' => 'Employee updated successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error updating record: '. $e->getMessage()
            ], 500);
        }
    }
}

