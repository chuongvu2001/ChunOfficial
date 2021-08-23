<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequestForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Models\Product;
use App\Models\Category;
use App\Models\Option;
use App\Models\Size;
use App\Models\Color;
use App\Models\Attribute;
use Illuminate\Support\Str;
class ProductController extends Controller
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
            $products = Product::where(
                'name', 'like', "%".$request->keyword."%"
            )
                ->paginate(100);
            $products->withPath('?keyword=' . $request->keyword);
        }else{
            $products = Product::all();
            $products->load('category');
//            $products->load('skills');
//            $products->load('params');
//            $products->load('attribute');
//            dd($products->quantity());
        }
        $keyword = $request->keyword;
        return view('backend.products.list',compact('products','keyword'));
    }
    public function detail($id){
        $product =Product::find($id);
        $product_new = $product->quantity();
        return view('backend.products.detail',compact('product','product_new'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        $sizes = Size::all();
//        $colors = Color::all();
//        return view('backend.products.option',compact('sizes','colors'));
        $cates = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('backend.products.add',compact('cates','sizes','colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequestForm $request)
    {
        //
        $options = Option::all();
        foreach ($options as $o => $item){
            $color = $item->color;
            $size = $item->size;
            $amount = $item->amount;
            $colors = Color::where("color","like","%".$color."%")->count();
            if($colors > 0){
                $new_color = Color::where("color","like","%".$color."%")->first();
            }
        }
        $datetime = Carbon::now('Asia/Ho_Chi_Minh');
        $product = new Product();
        $data = [
            'name'=>$request->name,
            'price'=>$request->price,
            'price_sale'=>$request->price_sale != null ? $request->price_sale : 0,
            'sku'=>$request->sku,
            'shorts'=>$request->shorts,
            'description'=>$request->description,
            'image'=>$request->image,
            'cate_id'=>$request->cate_id,
            'status'=>1,
            'brand'=>$request->brand,
            'thumbnail1'=>$request->thumbnail1,
            'thumbnail2'=>$request->thumbnail2,
            'thumbnail3'=>$request->thumbnail3,
            'slug'=>Str::slug($request->name,"-"),
            'created_at'=>$datetime
        ];
        $product->fill($data);
        $product->save();
        $pro_id = $product->id;
//        return redirect(url('admin/san-pham'));
        $sizes = Size::all();
        $colors = Color::all();
        return view('backend.products.option',compact('sizes','colors','pro_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $product = Product::where('id',$request->pro_id)->first();
        $product->load('category');
//        $attribute = Attribute::where('pro_id',$request->pro_id)->get();
        $product_new = $product->quantity();
//        return response()->json([
//            'data'=>$product,
//            'product_new' => $product_new
//        ]);
        $data = [
            'product'=>$product,
            'product_new'=>$product_new
        ];
        echo json_encode($data);
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
        $product = Product::find($id);
        $product_new = $product->quantity();
        return view("backend.products.edit",compact('product','product_new','cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequestForm $request, $id)
    {
        //
        $product = Product::find($id);
        $product->fill($request->all());
        $product->save();
        return redirect(url('admin/san-pham'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $product = Product::find($request->id)->delete();
        $attribute = Attribute::where('pro_id',$request->id)->delete();
        $products = Product::all();
        echo json_encode($products);
    }
    public function uploadImage(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();
        $path =  $request->file('file')->storeAs('uploads',$fileName,'public');
        // $imgpath = $request->file('file')->store('uploads', 'public');
        return response()->json(['location' => "/storage/$path"]);
    }
    public function xoaStatus(Request $request){
        $status = Product::find($request->id);
        $status->status = 0;
        $status->save();
        $products = Product::all();
        $products->load('category');
        echo json_encode($products);
        // return redirect('danh-muc');
    }
    public function editStatus(Request $request){
        $status = Product::find($request->id);
        $status->status = 1;
        $status->save();
        $products = Product::all();
        $products->load('category');
        echo json_encode($products);
        // return redirect('danh-muc');
    }
    public function options(Request $request){
        $size = Size::where("size","like","%".$request->size."%")->count();
        $color = Color::where("color","like","%".$request->color."%")->count();
        if($size > 0){
            $new_size = Size::where("size","like","%".$request->size."%")->first();
            $id_size = $new_size->id;
        }else{
            $new_size = new Size();
            $data = [
                'size'=>$request->size
            ];
            $new_size->fill($data);
            $new_size->save();
            $id_size = $new_size->id;
        }
        if($color > 0){
            $new_color = Color::where("color","like","%".$request->color."%")->first();
            $id_color = $new_color->id;
        }
        else{
            $new_color = new Color();
            $data = [
                'color' => $request->color
            ];
            $new_color->fill($data);
            $new_color->save();
            $id_color = $new_color->id;
        }
        $option = new Option();

        $op=[
            'color'=>$request->color,
            'size'=>$request->size,
            'amount'=>$request->amount
        ];

        $option->fill($op);
        $option->save();

        $data= [
            'size_id'=>$id_size,
            'color_id'=>$id_color,
            'amount'=>$request->amount,
            'pro_id'=>$request->pro_id,
            'option_id' =>$option->id
        ];

        $attribute = new Attribute();
        $attribute->fill($data);
        $attribute->save();

        $options = Option::all();
        echo json_encode($options);
    }
    public function success(){
        $options =  Option::truncate();
        return redirect(url('admin/san-pham'));
    }
    public function xoa(Request $request){
        $option = Option::find($request->option_id)->delete();
        $attribute = Attribute::where('option_id',$request->option_id)->delete();
        $options = Option::all();
        echo json_encode($options);
    }

}
