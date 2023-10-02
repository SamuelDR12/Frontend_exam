<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompaniesRequest;
use Illuminate\Support\Facades\File;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Companies::simplePaginate(10);
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompaniesRequest $request)
    {
        // Validation passed;
        $validatedData = $request->validated();
        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $ext = $file->getClientOriginalExtension();
            $image_name = time() . '.' . $ext;

            // Store the file in the storage/app/public/logos directory
            $path = $file->storeAs('public/logos', $image_name);

            // Create a URL to access the file
            $url = asset('storage/logos/' . $image_name);
        } else {
            // Handle the case where no company logo was uploaded
            $url = null; // Set a default or handle it according to your application logic
        }

        $company = Companies::create([
            'name' => $request->company_name,
            'email' => $request->company_email,
            'logo' => $image_name, // Store the URL of the logo
            'website' => $request->company_website,
        ]);

        if (!$company) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while creating a company.');
        }

        return redirect()->route('companies.index')->with('success', 'Success, your company has been created.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Companies $company)
    {
        return view('company.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompaniesRequest $request, Companies $companies)
    {
        // Validate the request data
    $validatedData = $request->validated();
    $companies = Companies::find($request->id);
    $companies->name = $validatedData['company_name'];
    $companies->email = $validatedData['company_email'];
    $companies->website = $validatedData['company_website'];

    // Handle the company logo upload (if provided)
    if ($request->hasFile('company_logo')) {
        $path = 'storage/logos/'. $companies->logo;
        if(File::exists($path))
            {
                File::delete($path);
            }
        $file = $request->file('company_logo');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;

            // Store the file in the storage/app/public/logos directory
            $path = $file->storeAs('public/logos', $fileName);

        // Update the company's logo field with the file name
        $companies->logo = $fileName;
    }

    if (!$companies->save()) {
        return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating your company.');
    }
    return redirect()->route('companies.index')->with('success', 'Success, your ompany have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Companies $company)
{
    // Check if the company exists
    if (!$company) {
        return response()->json(['message' => 'Company not found'], 404);
    }

    // Delete the company logo file
    $path = 'storage/logos/' . $company->logo;
    if (File::exists($path)) {
        File::delete($path);
    }

    // Delete the company
    $company->delete();

    return response()->json(['message' => 'Company deleted successfully']);
}
}
