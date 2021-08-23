<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewFormRequest;
use App\Models\CategoryNew;
use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = News::all();
        $news->load('get_cate');
        $news->load('get_user');
        return view('backend.news.blog',compact('news'));
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
        return view('backend.news.addBlog',compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewFormRequest $request)
    {
        //
        $news = new News();
        $news->fill($request->all());
        $news->slug = \Illuminate\Support\Str::slug($request->title,"-");
        $news->user_id = Auth::user()->id;
        $news->save();
        return redirect()->back()->with('success','Thêm bản tin thành công!');
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
        $cates = CategoryNew::all();
        $new = News::find($id);
        return view('backend.news.editBlog',compact('cates','new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewFormRequest $request, $id)
    {
        //
        $news = News::find($id);
        $news->fill($request->all());
        $news->slug = \Illuminate\Support\Str::slug($request->title,"-");
        $news->user_id = Auth::user()->id;
        $news->save();
        return redirect(url('admin/tin-tuc'))->with('success','Sửa bản tin thành công!');
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
        $new = News::find($id);
        $new->delete();
        return redirect()->back()->with("success",'Xoá bản tin thành công!');
    }
}
