<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Attr_Invoice;
use App\Models\CategoryNew;
use App\Models\Invoice;
use App\Models\Invoice_Product;
use App\Models\News;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Color;
use App\Models\Size;
use App\Models\Attribute;
//use Munna\ShoppingCart\Cart;
//use Munna\ShoppingCart\Facades\Cart;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tests\Fixtures\Models\Car;

class HomeController extends Controller
{
    //
    public function index()
    {
        $cates = Category::where('role', 0)->get();
        $cates->load('child');
        $cates->load('products');
        $cate1 = Category::where('name', 'like', "%Áo Nam%")->first();
        $product1 = Product::where('cate_id', $cate1->id)->orderBy('id', 'desc')->take(6)->get();
        $cate2 = Category::where('name', 'like', "%Quần Nam%")->first();
        $product2 = Product::where('cate_id', $cate2->id)->orderBy('id', 'desc')->take(6)->get();

//        $data_view =[];
        $product_sold = Product::where('status',1)->orderBy('sold', 'DESC')->get()->take(2);
//        foreach($product_sold as $s =>$item){
//            $id_sold = $item->id;
//            array_push($data_view,$id_sold);
//        }
        $product_view = Product::where('status',1)->orderBy('view','DESC')->get()->take(2);
        $product_random = Product::where('status',1)->inRandomOrder()->get()->take(2);

        $news = News::orderBy('view', 'DESC')->take(6)->get();
        return view('frontend.index', compact('cates','news', 'cate1', 'product1', 'product2','product_sold','product_view','product_random'));
    }

    public function productDetail($slug, $id)
    {
        $cates = Category::where('role', 0)->get();
        $cates->load('child');

        $arr = explode(".", $id);
        $id = array_shift($arr);
        $product = Product::find($id);
        $stars = Comment::where('pro_id', $product->id)->where('parent_id', 0)->get();
        $stars->load('user');
        $product_option = $product->quantity();
        return view('frontend.product-detail', compact('product', 'product_option', 'cates', 'stars'));
    }

    public function Options(Request $request)
    {
        foreach ($request->data as $key => $item) {
//            $object = (object) $item;
            foreach ($item as $o => $value) {
                if ($o == 'color') {
                    $color = $value;
                } else {
                    $size = $value;
                }
            }
        }
        if (!empty($color)) {
            $new_color = Color::where("color", "like", "%" . $color . "%")->first();
//            $new_size = Size::where("size","like","%".$item['size']."%")->first();
        }
        if (!empty($size)) {
            $new_size = Size::where("size", "like", "%" . $size . "%")->first();
//            $new_size = Size::where("size","like","%".$item['size']."%")->first();
        }
        if (isset($new_color) && isset($new_size)) {
            $attribute = Attribute::where('color_id', $new_color->id)->where('size_id', $new_size->id)->where('pro_id', $request->pro_id)->count();
            if ($attribute > 0) {
                $attribute_new = Attribute::where('color_id', $new_color->id)->where('size_id', $new_size->id)->where('pro_id', $request->pro_id)->first();
                $request->session()->get('attribute');
                $data = [
                    'amount'=>$attribute_new->amount
                ];
                $request->session()->put('attribute',$data);
                echo json_encode($attribute_new);
            } else {
                $title = (object)[
                    'title' => 'Hết hàng',
                ];
                echo json_encode($title);
            }
        }
    }

    public function Cart(Request $request)
    {
        $product = Product::find($request->id);
        $product_new = $product->quantity();
        foreach ($product_new as $new =>$item){
            if($item->color_name == $request->color && $item->size_name == $request->size && $item->pro_id = $request->id){
                $amount_product = $item->amount;
            }
        }
        $cart = session()->get('cart');
        $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
        $cart = [
            'pro_id' => $product->id,
            'pro_name' => $product->name,
            'pro_image' => $product->image,
            'totalamount' => $amount_product,
            'pro_price' => $product->price_sale != 0 ? $product->price_sale : $product->price,
            'amount' => $request->amount,
            'color' => $request->color,
            'size' => $request->size,
            'slug'=>$product->slug,
            'total' => $request->amount * $price,
        ];
//        $arr = $request->session()->push($product->id, $data);
        $request->session()->push('cart', $cart);
        $success = "Đã thêm sản phẩm vào giỏ hàng!";
        echo json_encode($success);
//        return response()->json(['success' => 'Đã thêm sản phẩm vào giỏ hàng!']);
//        $product->price_sale != 0 ? $product_price = $product->price_sale : $product_price = $product->price;
////        $cart->add($product_id, $product_name, $product_image, $amount, $product_price);

    }

    public function showCart(Request $request)
    {
//        $request->session()->flush('cart');
        $cates = Category::where('role', 0)->get();
        $cates->load('child');
//      $request->session()->flush('cart');

        if(session()->has('auth')){
            $auth = session()->get('auth');
            $user = User::where("email","like","%".$auth."%")->first();
//            $user_id = $user->id;
            $voucher = $user->voucher();
        }
        return view('frontend.cart',compact('cates','voucher'));
    }
    public function openModal(Request $request){
        $product = Product::find($request->id);
        $product_new = $product->quantity();
        $data = [
            'product'=>$product,
            'product_new' => $product_new
        ];
        echo json_encode($data);
    }
    public function UpAmount(Request $request){
        $cart = session()->get('cart');
        if($cart){
            foreach ($cart as $c => $item){
                if($item['pro_id'] == $request->id && $item['color'] == $request->color && $item['size'] == $request->size){
                    if($cart[$request->c]['amount'] < $cart[$request->c]['totalamount']){
                        $cart[$request->c]['amount'] = $cart[$request->c]['amount']+1;
                        $cart[$request->c]['total'] = $cart[$request->c]['amount'] * $cart[$request->c]['pro_price'];
                    }
                    else{
                        $cart[$request->c]['amount'] = $cart[$request->c]['amount'];
                    }
                }
            }
            session()->put('cart',$cart);

            $key = 'total';
            $sum = array_sum(array_column($cart,$key));
            if(session()->has('ship-cod') ==true){
                $shipcod = session()->get('ship-cod');
                $data = [
                    "key"=>$request->c,
                    'amount' => $cart[$request->c]['amount'],
                    'total' => $cart[$request->c]['total'],
                    'bill' => $sum,
                    "ship"=> $shipcod['ship'],
                    'pay' =>$sum + $shipcod['ship']
                ];
            }
            if(session()->has('voucher') == true){
                $voucher = session()->get('voucher');
                if(session()->has('ship-cod') == true){
                    $shipcod = session()->get('ship-cod');
                }
                if(isset($voucher['freeship'])){
                    $data = [
                        "key"=>$request->c,
                        "freeship"=>$voucher['freeship'],
                        'amount' => $cart[$request->c]['amount'],
                        'total' => $cart[$request->c]['total'],
                        'bill' => $sum,
                        'ship'=>session()->has('ship-cod') ==true? $shipcod['ship']: 20000,
                        'pay'=>session()->has('ship-cod') ==true? $sum + $shipcod['ship'] - $voucher['freeship'] : $sum-$voucher['freeship'] ,
                    ];
                }
                else{
                    $sale = $sum * $voucher['phantram'];
                    $data = [
                        "key"=>$request->c,
                        'amount' => $cart[$request->c]['amount'],
                        'total' => $cart[$request->c]['total'],
                        'bill' => $sum,
                        "phantram"=>$voucher['phantram'],
                        "sale"=> $sale,
                        'ship'=>session()->has('ship-cod') ==true? $shipcod['ship']: 20000,
                        'pay'=>session()->has('ship-cod') ==true? $sum + $shipcod['ship'] - $sale : $sum +20000 -$sale ,
                    ];
                }
            }
            if(!session()->get('voucher') && !session()->get('ship-cod')){
                $data = [
                    'key'=>$request->c,
                    'amount' => $cart[$request->c]['amount'],
                    'total' => $cart[$request->c]['total'],
                    'bill' => $sum ,
                    'pay' => $sum+20000
                ];
            }
            echo json_encode($data);
        }
    }
    public function DownAmount(Request $request){
        $cart = session()->get('cart');
        if($cart){
            foreach ($cart as $c => $item){
                if($item['pro_id'] == $request->id && $item['color'] == $request->color && $item['size'] == $request->size){
                    if($cart[$request->c]['amount']>1){
                        $cart[$request->c]['amount'] = $cart[$request->c]['amount']-1;
                        $cart[$request->c]['total'] = $cart[$request->c]['amount'] * $cart[$request->c]['pro_price'];
                    }
                    else{
                        $cart[$request->c]['amount'] =1;
                    }
                }
            }
            session()->put('cart',$cart);
            $key = 'total';
            $sum = array_sum(array_column($cart,$key));
            if(session()->has('ship-cod') ==true){
                $shipcod = session()->get('ship-cod');
                $data = [
                    "key"=>$request->c,
                    'amount' => $cart[$request->c]['amount'],
                    'total' => $cart[$request->c]['total'],
                    'bill' => $sum,
                    "ship"=> $shipcod['ship'],
                    'pay' =>$sum + $shipcod['ship']
                ];
            }
            if(session()->has('voucher') == true){
                $voucher = session()->get('voucher');
                if(session()->has('ship-cod') == true){
                    $shipcod = session()->get('ship-cod');
                }
                if(isset($voucher['freeship'])){
                    $data = [
                        "key"=>$request->c,
                        "freeship"=>$voucher['freeship'],
                        'amount' => $cart[$request->c]['amount'],
                        'total' => $cart[$request->c]['total'],
                        'bill' => $sum,
                        'ship'=>session()->has('ship-cod') ==true? $shipcod['ship']: 20000,
                        'pay'=>session()->has('ship-cod') ==true? $sum + $shipcod['ship'] - $voucher['freeship'] : $sum-$voucher['freeship'] ,
                    ];
                }
                else{
                    $sale = $sum * $voucher['phantram'];
                    $data = [
                        "key"=>$request->c,
                        'amount' => $cart[$request->c]['amount'],
                        'total' => $cart[$request->c]['total'],
                        'bill' => $sum,
                        "phantram"=>$voucher['phantram'],
                        "sale"=> $sale,
                        'ship'=>session()->has('ship-cod') ==true? $shipcod['ship']: 20000,
                        'pay'=>session()->has('ship-cod') ==true? $sum + $shipcod['ship'] - $sale : $sum +20000 -$sale ,
                    ];
                }
            }
            if(!session()->get('voucher') && !session()->get('ship-cod')){
                $data = [
                    'key'=>$request->c,
                    'amount' => $cart[$request->c]['amount'],
                    'total' => $cart[$request->c]['total'],
                    'bill' => $sum ,
                    'pay' => $sum+20000
                ];
            }

            echo json_encode($data);
        }
    }
    public function RemoveCart($id)
    {
        if (isset($id)) {
            $cart = session()->get('cart');
            unset($cart[$id]);
//            $value = $request->session()->pull('key', $arr);
//                if ($item['pro_id'] == $request->id && $item['color'] == $request->color && $item['size'] == $request->size) {
//                    dd($cart);
//                }
            if(count($cart) > 0){
                session()->forget('cart');
                foreach ($cart as $key => $item){
                    $data = [
                        'pro_id' => $item['pro_id'],
                        'pro_name' => $item['pro_name'],
                        'pro_image' => $item['pro_image'],
                        'totalamount' => $item['totalamount'],
                        'pro_price' => $item['pro_price'],
                        'amount' => $item['amount'],
                        'color' =>  $item['color'],
                        'size' => $item['size'],
                        'slug'=>$item['slug'],
                        'total' =>$item['total'],
                    ];
                    session()->get('cart');
                    session()->push('cart',$data);
                }
            }
            else{
                session()->forget('cart');
                session()->forget('ship-cod');
                session()->forget('voucher');
            }

            return redirect()->back()->with('success','Đã xoá sản phẩm trong giỏ');
        }
    }
    public function CheckVoucher(Request $request){
        $voucher = Voucher::find($request->voucher_id);
        $voucher_name = $voucher->name;
        $arr = explode(" ", $voucher_name);
        $name = array_pop($arr);

        $request->session()->get('voucher');
        $cart = $request->session()->get('cart');
        $key = 'total';
        $sum = array_sum(array_column($cart,$key));
        if($name == "ship"){
            $value = 20000;
            $pay = $sum-$value;
            if(session()->has('ship-cod')){
                $shipcod = session()->get('ship-cod');
            }
            $data = [
                'sum'=>$sum,
                'freeship'=>$value,
                'pay'=>session()->has('ship-cod') ==true? $pay+ $shipcod['ship']: $pay+ 20000 ,
                'ship'=>session()->has('ship-cod') ==true? $shipcod['ship']: 20000
            ];
            $request->session()->put('voucher',$data);
            echo json_encode($data);
        }
        else{
            $phantram = (int)$name;
            $value = $phantram/100;
            $sale = $sum*$value;
            $pay = $sum-$sale;
            if(session()->has('ship-cod')){
                $shipcod = session()->get('ship-cod');
            }
            $data = [
                'sum'=>$sum,
                'phantram'=>$value,
                'sale' => $sale,
                'pay'=>session()->has('ship-cod') ==true? $pay+ $shipcod['ship']: $pay+ 20000  ,
                'ship'=>session()->has('ship-cod') ==true? $shipcod['ship']: 20000
            ];
            $request->session()->put('voucher',$data);
            echo json_encode($data);
        }
    }
    public function CheckAddress(Request $request){
        $request->session()->get('ship-cod');
        if($request->address ==1){
            $ship = 20000;
        }
        else if($request->address ==2){
            $ship = 30000;
        }
        else if($request->address == 3){
            $ship = 35000;
        }
        else{
            $ship = 40000;
        }
        if(session()->has('voucher') ==true){
            $voucher = session()->get('voucher');
        }
        $key = 'total';
        $cart = $request->session()->get('cart');
        $sum = array_sum(array_column($cart,$key));
        $voucher = session()->get('voucher');
        if(isset($voucher['freeship'])){
            $data = [
                'ship'=>$ship,
                'sum' => session()->has('voucher') ==true? $voucher['sum']  : $sum,
                'pay'=> session()->has('voucher') ==true? $voucher['sum'] + $ship - $voucher['freeship']  : $sum + $ship,
            ];
        }
        else{
            $data = [
                'ship'=>$ship,
                'sum' => session()->has('voucher') ==true? $voucher['sum'] : $sum,
                'pay'=> session()->has('voucher') ==true ? $voucher['sum'] + $ship - $voucher['sale']  : $sum + $ship,
            ];
        }
        $request->session()->put('ship-cod',$data);
        $shipcod = session()->get('ship-cod');
        echo json_encode($data);
    }
    public function UpQty(Request $request){
        $qty = $request->qty +1;
        if(session()->has('attribute')){
            $amount = session()->get('attribute');
            $amount['amount'] > $request->qty ? $qty = $request->qty + 1 : $qty = $amount['amount'];
        }
        echo json_encode($qty);
    }
    public function DownQty(Request $request){
        $qty = $request->qty - 1;
        if($qty == 0){
            $qty = 1;
        }
        echo json_encode($qty);
    }
    public function CheckOut(Request $request){
       $data = [
            'sum'=> $request->sum,
           'ship'=>$request->ship != "" ? $request->ship: 20000,
           'voucher_ship'=>$request->voucher_ship != "" ? $request->voucher_ship : '',
            'voucher_sale'=>$request->voucher_sale != ""? $request->voucher_sale : '',
           'pay'=>$request->pay,
           'phantram'=>$request->phantram != "" ? $request->phantram : '',
       ];
       $request->session()->get('checkout');
       $request->session()->put('checkout',$data);
       echo json_encode($data);
    }
    public function CheckOutVerify(){
        if(session()->has('auth')){
            $cates = Category::where('role', 0)->get();
            $cates->load('child');
            $city = Address::where('role',0)->get();
            $city->load('get_child');
            return view('frontend.checkout',compact('cates','city'));
        }
        else{
            return redirect(url('login/member'));
        }

    }
    public function Town(Request $request){
        $town = Address::where('role',$request->city)->get();
        echo json_encode($town);
    }

    public function ProductSidebar($slug){
        $arr = explode('-', $slug );
        $string = implode(' ', $arr);
        if($string == "san pham"){
            $products = Product::paginate(9);
            $cates = Category::where('role', 0)->get();
            $cates->load('child');
            $cate_name = "Sản phẩm";
            $color = Color::select('color')->distinct()->get();
            $products_tag = Product::select('brand')->distinct()->get();
            return view('frontend.product-sidebar',compact('cate_name','products','cates','color','products_tag'));
        }
        else if($string == "tin tuc"){
            $news = News::orderBy('id','DESC')->take(4)->get();
            $news->load('get_cate');
            $cates = Category::where('role', 0)->get();
            $cates->load('child');
            $cates_news = CategoryNew::where('role', 0)->get();
            $cates_news->load('child');
            $cate_name = "Tin tức";
            $news_top = News::orderBy('view','DESC')->take(4)->get();
            $news_tag = News::select('cate_id')->get();
            $news_top->load('get_cate');
            return view('frontend.blog-list',compact('news','cates_news','cates','news_tag','news_top','cate_name'));
        }
        else{

        }
    }
    public function ProductCategorySidebar($slug,$id){
        $cates = Category::where('role', 0)->get();
        $cates->load('child');
        $products_cate = Product::where('cate_id',$id)->paginate(9);
        $cate_name = Category::find($id)->name;
        $color = Color::select('color')->distinct()->get();
        $products_tag = Product::select('brand')->distinct()->get();
        return view('frontend.product-sidebar',compact('cate_name','products_cate','cates','color','products_tag'));
    }
    public function filterOrder(Request $request){
        if($request->order_by == 1 && $request->order_new == 1){
            $product_by = Product::orderBy('price', 'DESC')->orderBy('id', 'DESC')->get();
        }
        else if($request->order_by == 1 && $request->order_new == 2){
            $product_by = Product::orderBy('price', 'DESC')->orderBy('sold', 'DESC')->get();
        }
        else if($request->order_by == 1 && $request->order_new == 3){
            $product_by = Product::orderBy('price', 'DESC')->orderBy('view', 'DESC')->get();
        }
        else if($request->order_by == 2 && $request->order_new == 1){
            $product_by = Product::orderBy('price', 'ASC')->orderBy('id', 'DESC')->get();
        }
        else if($request->order_by == 2 && $request->order_new == 2){
            $product_by = Product::orderBy('price', 'ASC')->orderBy('sold', 'DESC')->get();
        }
        else if($request->order_by == 2 && $request->order_new == 3){
            $product_by = Product::orderBy('price', 'ASC')->orderBy('view', 'DESC')->get();
        }
        echo json_encode($product_by);
    }
    public function RangePrice(Request $request){
        $arr = explode('-', $request->value );
        $string = implode(' ', $arr);
        $new_string = trim($string);
        $new_arr = explode('₫', $new_string );
        $value1 = trim($new_arr[0]);
        $value2 = trim($new_arr[1]);
        $new_value1 = rtrim($value1);
        $new_value2 =  rtrim($value2);
        $value_new_min = (int)str_replace(".", "", $new_value1);
        $value_new_max = (int)str_replace(".", "", $new_value2);
        $rangefilter = Product::where('price','>',$value_new_min)->where('price','<',$value_new_max)->get();
        echo json_encode($rangefilter);
    }
    public function ColorFilter(Request $request){
        $color = Color::where("color","like","%".$request->color."%")->first();
        $color_id = $color->id;
        $attribute = Attribute::where('color_id',$color_id)->select('pro_id')->distinct()->get();
        $attribute->load('products');
        echo json_encode($attribute);
    }
    public function BrandFilter(Request $request){
        $brand = Product::where("brand","like","%".$request->brand."%")->get();
        echo json_encode($brand);
    }
    public function newDetail($slug,$id){
        $cates = Category::where('role', 0)->get();
        $cates->load('child');
        $cates_news = CategoryNew::where('role', 0)->get();
        $cates_news->load('child');
        $arr = explode('.', $id );
        $value = $arr[0];
        $new = News::find($value);
        $new->load('get_cate');
        $new->load('get_user');
        $news_top = News::orderBy('view','DESC')->take(4)->get();
        $news_tag = News::select('cate_id')->get();
        $news_top->load('get_cate');
        return view('frontend.blog-single',compact('cates','new','news_top','news_tag','cates_news'));
    }
    public function submitCheckout(Request $request){
        $confirmation_code = time().uniqid(true);
        $model = new Invoice();
        $model->fill($request->all());
        $model->email = $request->email != "" ? $request->email : Auth::user()->email;
        $model->user_id = Auth::user()->id;
        if(session()->has('checkout')){
            $checkout = $request->session()->get('checkout');
        }
        $pay =str_replace('.', '',  $checkout['pay']);
        $sum = str_replace('.','', $checkout['sum']);
        $ship =  str_replace('.','', $checkout['ship']);
        $model->ship = $ship;
        if($checkout['voucher_sale'] != ""){
            $voucher = Voucher::where("name","like","%".$checkout['phantram']."%")->first();
            $voucher_id_sale = $voucher->id;
            $voucher_sale =  str_replace('.','', $checkout['voucher_sale']);
            $model->voucher_sale = $voucher_sale;
            $model->voucher_id = $voucher_id_sale;
        }
        if(!empty($checkout['voucher_ship'])){
            $voucher =  Voucher::where("name","like","%free ship%")->first();
            $voucher_id_ship = $voucher->id;
            $voucher_ship =  str_replace('.','', $checkout['voucher_ship']);
            $model->voucher_sale = $voucher_ship;
            $model->voucher_id = $voucher_id_ship;
        }
        $model->total = $pay;
        $model->sum = $sum;
        $model->confirmation_code = $confirmation_code;
        $model->save();

        $cart = $request->session()->get('cart');
        foreach ($cart as $c => $item){
            $data = [
                "name"=>$item['pro_name'],
                "image"=>$item['pro_image'],
                "size"=>$item['size'],
                "color"=>$item['color'],
                "amount"=>$item['amount'],
                "price"=>$item['pro_price'],
                "total"=>$item['total'],
                "pro_id"=>$item['pro_id'],
                "stock"=>$item['totalamount'],
            ];
            $invoice_product = new Invoice_Product();
            $invoice_product->fill($data);
            $invoice_product->save();

            $datainvoi = [
                "invoice_id"=>$model->id,
                "invoice_product_id"=>$invoice_product->id,
            ];
            $attr_invoice = new Attr_Invoice();
            $attr_invoice->fill($datainvoi);
            $attr_invoice->save();
        }

        Mail::send('email.checkout-verify',['confirmation_code'=>$confirmation_code,'model'=>$model], function($message) use ($request) {
            $message->from('theanh11220011@gmail.com');
            $message->to($request->email != "" ? $request->email: Auth::user()->email);
            $message->subject('Xác nhận thanh toán');
        });
        return redirect(url('/'));
    }
    public function verifyCustomer($code)
    {
        $invoice = Invoice::where('confirmation_code', $code);
        if ($invoice->count() > 0) {
            $invoice->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);
            $notification_status = 'Bạn đã xác nhận thành công';
        } else {
            $notification_status ='Mã xác nhận không chính xác';
        }
        return redirect(url('/'));
    }
}
