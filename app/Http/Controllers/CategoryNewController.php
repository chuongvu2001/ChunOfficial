<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\CategoryNew;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class CategoryNewController extends Controller
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
            $cates = CategoryNew::where(
                'name', 'like', "%".$request->keyword."%"
            )
                ->paginate(100);
            $cates->withPath('?keyword=' . $request->keyword);
            $cates->load('child');
        }else{
            $cates = CategoryNew::all();
            $cates->load('child');
        }
        $keyword = $request->keyword;
        // foreach($cates as $c){
        //   dd($c->name);
        // }
        return view('backend.categories_news.cate',compact('cates','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cates = CategoryNew::all();
        return view('backend.categories_news.addCate',compact('cates'));
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
        $cates = new CategoryNew();
        $cates->name = $request->input('name');
        $cates->role = $request->input('role');
        $cates->status = 1;
        $cates->slug = Str::slug($request->name,"-");
        $datetime = Carbon::now('Asia/Ho_Chi_Minh');
        $cates->created_at = $datetime;
        $cates->updated_at = null;
        $cates->save();
        return redirect(url('admin/chuyen-muc'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $cate_name = CategoryNew::where('id',$id)->first();
        //
        if($request->keyword){
            $cate = CategoryNew::where(
                'name', 'like', "%".$request->keyword."%"
            )
                ->paginate(5);
            $cate->withPath('?keyword=' . $request->keyword);
            $cate->load('child');
        }else{
            $cate = CategoryNew::where('role',$id)->get();
            $cate->load('child');
        }
        $keyword = $request->keyword;
        // foreach($cates as $c){
        //   dd($c->name);
        // }
        return view('backend.categories_news.cateDetail',compact('cate','keyword','cate_name'));

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
        $cates = CategoryNew::all();
        $cates->load('child');
        $cate = CategoryNew::where('id',$id)->first();
        return view('backend.categories_news.editCate',compact('cate','cates'));
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
        $cate = CategoryNew::find($id);
        $cate->name = $request->input('name');
        $cate->status = 1;
        $cate->slug = Str::slug($request->name,"-");
        $datetime = Carbon::now('Asia/Ho_Chi_Minh');
        $cate->updated_at = $datetime;
        $cate->save();
        return redirect(url('admin/chuyen-muc'));
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
        $cate =CategoryNew::find($id);
        $cate->delete();
        $cate_detail = CategoryNew::where('role',$id)->delete();
//        $products = Product::where('cate_id',$id)->delete();
        $cates = CategoryNew::all();
        $cates->load('child');
        echo json_encode($cates);
        // return redirect('danh-muc');
    }
    public function checkName(Request $req){
        $name = $req->input('name');
        $count = CategoryNew::where('name', $name)->count();
        echo json_encode($count <= 0);
        die;
    }
    public function xoaStatus($id){
        $status = CategoryNew::find($id);
        $status->status = 0;
        $status->save();
        $cates = CategoryNew::all();
        $cates->load('child');
        echo json_encode($cates);
        // return redirect('danh-muc');
    }
    public function editStatus($id){
        $status = CategoryNew::find($id);
        $status->status = 1;
        $status->save();
        $cates = CategoryNew::all();
        $cates->load('child');
        echo json_encode($cates);
        // return redirect('danh-muc');
    }
}

