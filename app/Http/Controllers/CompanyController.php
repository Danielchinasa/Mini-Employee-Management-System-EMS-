<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(2);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'website' => 'required',
            'email' => 'required',
            'address' => 'required',
            'logo' => 'required',
        ]);
        
        $path = '';
        $c_name= $request->name;
        $company_name = $c_name;
        if ($request->file('logo')->isValid()) {
            //
            $extension = $request->logo->extension();
            $file_name = $company_name.'.'.$extension;
            $path = $request->logo->storeAs('public', $file_name);
        }
        
       $company = Company::create([
            'name' => $request->name,
            'website' => $request->website,
            'email' => $request->email,
            'address' => $request->address,
            'logo' => $path
        ]);

        return back()->with('success', 'Company added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company_id)
    {
        $this->validate($request, [
            'logo' => 'required',
        ]);
        
        $company = Company::findOrFail($company_id);

        $path = '';
        $c_name= $request->name;
        $company_name = $c_name;
        if ($request->file('logo')->isValid()) {
            //
            $extension = $request->logo->extension();
            $file_name = $company_name.'.'.$extension;
            $path = $request->logo->storeAs('public', $file_name);
        }

        $company->update(
            [
                'name' => $request->name,
                'website' => $request->website,
                'email' => $request->email,
                'address' => $request->address,
                'logo' => $path
            ]
        );

        return back()->with('status', 'Company Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id)
    {
        $company = Company::find($company_id);
        $company->delete();

        return back()->with('status', 'Company deleted successfully');

    }
}
