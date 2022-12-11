<?php

namespace App\Http\Controllers;

use Exception;
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

    public function editCategory($id) {

        $allCategories = Category::select('title','id')->whereNotIn('id',[$id])->get();
        $category = Category::find($id);
  
        return view('add-category')
                ->with('category',$category)
                ->with('allCategories',$allCategories)
                ->with('category_id',$id);
     }

    public function saveCategory(Request $request) {

        
        $request->validate([
            'title' => 'required',

        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        
        try {
            Category::create($input);

        }catch(Exception $e) {
           
            return back()->with('status', 'Category already exists');
        }
        

        return back()->with('status', 'New Category added successfully.');
    }


    public function updateCategory($id,Request $request) {

        try {
            $catobj = Category::findOrFail($id);

            $catobj->title = $request->title;
            $catobj->parent_id = $request->parent_id;
            $catobj->save();

            return back()->with('status', 'Category updated successfully.');

        }catch(Exception $e) {
           
            return back()->with('status', 'Category not exists or same sub category name exist within category');
        }


    }

    public function catlist() {

        $allCategories = Category::select('title','id','parent_id')->get();
        return view('categorylist',compact('allCategories'));

    }

    public function deleteCategory($id) {
        //die;
        $catobj = Category::findOrFail($id);
        $catobj->delete();
        if($catobj->childs->count()) {

            foreach($catobj->childs as $sub_cat) {
                $this->deleteCategory($sub_cat->id);
            }
        }

        return redirect('/category-list')->with('status','Delete this category with all nested category..');
        //dd($cat_id);

    }


}
