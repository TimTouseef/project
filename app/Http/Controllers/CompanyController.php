<?php

namespace App\Http\Controllers;

use App\Http\Controllers\companycontroller as ControllersCompanycontroller;
use App\Models\Company;
use App\Models\company as ModelsCompany;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::select('id','name','email','website','logo')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';


                return $btn;
         })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('company');
    }


    public function create()
    {
        return view('company');
    }

    public function show(Company $company)
        {
            return view('companies.show',compact('company'));
        }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
       $file = $request->file('logo');
        $filename = $file->getClientOriginalName();
        $filePath = $file->move('images',$filename,'public');
        }
        Company::updateOrCreate(
            ['id' => $request->company_id],
            [
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => isset($filePath) ? $filePath : $request->logo,
            ]
        );
      //  dd($file);
       return response()->json(['res'=>'Company Created Successfully']);
    }

    public function edit($id)
    {
        $company = Company::find($id);
        return response()->json($company);
    }

   // public function store(Request $request){
     //   $file = $request->file('file');
       // $filename = time().''.$file->getClientOriginalName();
        //$filePath = $file->storeAs('image',$filename,'public');
       // Company::updateOrCreate(['id'=>$request->company_id],
   // [   'name' => $request->name,
     //   'email' => $request->email,
     //   'website' => $request->website,
     //   'logo' => $filePath
    //]);
   // return response()->json(['success'=>'Company Added Successfully']);
   // }
   public function destroy($id)
    {
        Company::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
