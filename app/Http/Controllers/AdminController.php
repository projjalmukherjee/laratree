<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index () {
       
        $categories = Category::where('parent_id', '=', 0)->get();
        
       
        return view('admin-dashboard',compact('categories'));
       
    }

    public function addCategory() {

        $allCategories = Category::select('title','id')->get();
        return view('add-category',compact('allCategories'));

    }

    public function saveCategory(Request $request) {

        
        $request->validate([
            'title' => 'required|unique:categories,title',
        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        
        Category::create($input);
        return back()->with('status', 'New Category added successfully.');
    }


    public function catlist() {

        $allCategories = Category::select('title','id','parent_id')->get();
        return view('categorylist',compact('allCategories'));

    }


}
