<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::all();
        return view('backend.pages.product.brandIndex',compact('brands'));
    }

    public function create()
    {
        return view('backend.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required | email | unique:customers',
           
        ]);
        $brand = new Brand();
        $brand->date = date('Y-m-d');
        $brand->name = $request->name;
        $brand->created_by = auth()->user()->id;
        $brand->save();
        toastr()->success('Brand has been Updated successfully!');
        return redirect()->route('brand.index');
    }

    public function show($id)
    {
        return view('backend.brands.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('backend.brands.edit', ['id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        $brand->update([
            'name'=>$request->name,
            'created_by'=>auth()->user()->id,   
        ]);
        toastr()->success('Brand has been Updated successfully!');
        return back();
    }
     public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        toastr()->success('Brand has been Deleted successfully!');
        return back();
    }
}
