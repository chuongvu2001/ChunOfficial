<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->keyword){
            $cates = Category::where(
                'name', 'like', "%".$request->keyword."%"
            )
                ->paginate(100);
            $cates->withPath('?keyword=' . $request->keyword);
            $cates->load('child');
        }else{
            $cates = Category::all();
            $cates->load('child');
        }
        $keyword = $request->keyword;
        // foreach($cates as $c){
        //   dd($c->name);
        // }
        return view('backend.categories.cate',compact('cates','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cates = Category::all();
        return view('backend.categories.addCate',compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //
        $cates = new Category();
        $cates->name = $request->input('name');
        $cates->role = $request->input('role');
        $cates->status = 1;
        $cates->slug = Str::slug($request->name,"-");
        $datetime = Carbon::now('Asia/Ho_Chi_Minh');
        $cates->created_at = $datetime;
        $cates->updated_at = null;
        $cates->save();
        return redirect('admin/danh-muc');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $cate_name = Category::where('id',$id)->first();
        //
        if($request->keyword){
            $cate = Category::where(
                'name', 'like', "%".$request->keyword."%"
            )
                ->paginate(5);
            $cate->withPath('?keyword=' . $request->keyword);
            $cate->load('child');
        }else{
            $cate = Category::where('role',$id)->get();
            $cate->load('child');
        }
        $keyword = $request->keyword;
        // foreach($cates as $c){
        //   dd($c->name);
        // }
        return view('backend.categories.cateDetail',compact('cate','keyword','cate_name'));



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
        $cates = Category::all();
        $cates->load('child');
        $cate = Category::where('id',$id)->first();
        return view('backend.categories.editCate',compact('cate','cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //
        $cate = Category::find($id);
        $cate->name = $request->input('name');
        $cate->status = 1;
        $cate->slug = Str::slug($request->name,"-");
        $datetime = Carbon::now('Asia/Ho_Chi_Minh');
        $cate->updated_at = $datetime;
        $cate->save();
        return redirect('admin/danh-muc');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cate =Category::find($id);
        $cate->delete();
        $cate_detail = Category::where('role',$id)->delete();
        $products = Product::where('cate_id',$id)->delete();
        $cates = Category::all();
        $cates->load('child');

        echo json_encode($cates);
        // return redirect('danh-muc');
    }
    public function checkName(Request $req){
        $name = $req->input('name');
        $count = Category::where('name', $name)->count();
        echo json_encode($count <= 0);
        die;
    }
    public function xoaStatus($id){
        $status = Category::find($id);
        $status->status = 0;
        $status->save();
        $cates = Category::all();
        $cates->load('child');
        echo json_encode($cates);
        // return redirect('danh-muc');
    }
    public function editStatus($id){
        $status = Category::find($id);
        $status->status = 1;
        $status->save();
        $cates = Category::all();
        $cates->load('child');
        echo json_encode($cates);
        // return redirect('danh-muc');
    }
}

