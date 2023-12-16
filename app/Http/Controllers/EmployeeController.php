<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employee; // Import the Employee model
use App\Models\company; // Import the Company model
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('id','first_name','last_name','email','company_name','phone')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                 return $btn;
         })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee');
    }
    public function store(Request $request)
    {

        Employee::updateOrCreate([
            'id' => $request->employee_id
        ],
        [
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

return response()->json(['success'=>'Employee saved successfully.']);
        //$employee = new Employee();
    //$employee->first_name = $request->input('first_name');
    //$employee->last_name = $request->input('last_name');
 //   $employee->company_name = $request->input('company_name');
   // $employee->email = $request->input('email');
   // $employee->phone = $request->input('phone');
   // $employee->save();

    //return response()->json(['res'=>'Employee added Successfully']);
       }

       public function edit($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function destroy($id)
    {
        Employee::find($id)->delete();

        return response()->json(['success'=>'Employee deleted successfully.']);
    }

    public function getUsers(Request $request)
    {
        $employee = User::query();
    
      
        if ($request->has('company_name')) {
            $users->where('company_name', 'like', '%' . $request->input('company_name') . '%');
        }
     
    
        return Datatables::eloquent($employee)->toJson();
    }

    }
