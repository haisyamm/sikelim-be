<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::select('id','category_name','description','image')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name'=>'required',
            'description'=>'required'
        ]);

        try{
            if($request->image){
            $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('category/image', $request->image,$imageName);
            }else{
                $imageName ="";
            }
            Category::create($request->post()+['image'=>$imageName]);

            return response()->json([
                'message'=>'Category Created Successfully!!'
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while creating a category!!'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json([
            'category'=>$category
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name'=>'required',
            'description'=>'required',
            'image'=>'nullable'
        ]);

        try{

            $category->fill($request->post())->update();

            if($request->hasFile('image')){

                // remove old image
                if($category->image){
                    $exists = Storage::disk('public')->exists("category/image/{$category->image}");
                    if($exists){
                        Storage::disk('public')->delete("category/image/{$category->image}");
                    }
                }

                $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('category/image', $request->image,$imageName);
                $category->image = $imageName;
                $category->save();
            }

            return response()->json([
                'message'=>'Category Updated Successfully!!'
            ]);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while updating a category!!'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {

            if($category->image){
                $exists = Storage::disk('public')->exists("category/image/{$category->image}");
                if($exists){
                    Storage::disk('public')->delete("category/image/{$category->image}");
                }
            }

            $category->delete();

            return response()->json([
                'message'=>'Category Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a category!!'
            ]);
        }
    }
}
