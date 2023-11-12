<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $category;
    public function __construct(Category $category)
    {
       $this->$category=$category;
    }  
    /**
     * Display a listing of the resource.
     */

    
    public function index()
    {    
        $categories=DB::table('categories')->get();
        return view('admin.category', ['categories' => $categories]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $this->category->create($request->all() + ['slug' =>$request->title]);

        return back()->with('success' , "تم اضافة التصنيف بنجاح");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //$this->category::where('id', $id)->first()->delete();
        Category::destroy($id);
        
        return back()->with('success' , "تم حذف التصنيف بنجاح");
    }
 
}
