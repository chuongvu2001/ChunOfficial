<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthForm;
use App\Http\Requests\SignUpForm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware(['auth','verified']);
//    }
    //
    public function formRegister(){
        return view('frontend.register');
    }

    public function postLogin(Request $request){
//        dd(hash::make('12345678'));
        $request->validate(
            [
                'email' => ['required','regex:/(.+)@(.+)\.(.+)/i'],
                'password' => ['required','min:8'],
            ],[
                'email.required'=>"Bạn chưa nhập Email.",
                "email.regex"=>'Đinh dạng Email chưa đúng.',
                "password.required"=>"Mật khẩu không để trống.",
                "password.min"=>"Mật khẩu tối thiểu 8 ký tự.",
            ]
        );
        // dd(Hash::make('123456'));
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])
            // || Auth::attempt(['phone_number' => $request->email, 'password' => $request->password])
        ){
            // return redirect(route('homepage'));
            if(Auth::user()->confirmed == 1){
                $user = Auth::user();
                if($user->role == 100){
                    $user_admin =  auth()->user();
                    $user_admin->assignRole('admin');
                    $user_admin->givePermissionTo('admin public');
                    return redirect(url('admin/danh-muc'))->with('success','Đăng nhập thành công!');
                }
                else if($user->role == 10){
                    $user_staff =  auth()->user();
                    $user_staff->assignRole('user');
                    return redirect(url('admin/danh-muc'))->with('success','Đăng nhập thành công!');
                }
                else{
                    return redirect()->back()->with('error','Tài khoản không có quyền truy cập.');
                }
            }
            else{
                return redirect()->back()->with('error','Tài khoản chưa được kích hoạt.');
            }
        }
        else{
            $msg = "Tài khoản/mật khẩu không đúng!";
            return view('auth.login',compact('msg'));
        }
    }

    public function forgotPassword(Request $request){
        $request->validate(
            [
                'email' => ['required','regex:/(.+)@(.+)\.(.+)/i'],
            ],[
                'email.required'=>"Bạn chưa nhập Email.",
                "email.regex"=>'Đinh dạng Email chưa đúng.',
            ]
        );

        $user = User::whereEmail($request->email)->first();
        if($user == null){
            $msg = "Tài khoản không tồn tại!";
            return view('frontend.forgot',compact('msg'));
        }
        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        Mail::send('email.forgot-verify',['token'=>$token,'email'=>$request->email], function($message) use ($request) {
            $message->from('theanh11220011@gmail.com');
            $message->to($request->email);
            $message->subject('Reset Password');
        });
//        $request->session()->get('forgot');
//        $request->session()->put('forgot',$request->email);
        $msgsuccess = "Mã đã gửi đến email của bạn!";
        return view('frontend.forgot',compact('msgsuccess'));
    }
    public function getPassword($email,$token) {
        return view('auth.reset', ['token' => $token, 'email'=>$email]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $updatePassword = DB::table('password_resets')->where('token',$request->token)
            ->first();
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
           else{
               User::where('email', $updatePassword->email)
                   ->update(['password' => Hash::make($request->password)]);
               DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();
               return redirect(url('login/member'))->with('message', 'Mật khẩu của bạn đã được thay đổi!');
           }
    }

    public function postMember(Request $request){
        $request->validate(
            [
                'email' => ['required','regex:/(.+)@(.+)\.(.+)/i'],
                'password' => ['required','min:8'],
            ],[
                'email.required'=>"Bạn chưa nhập Email.",
                "email.regex"=>'Đinh dạng Email chưa đúng.',
                "password.required"=>"Mật khẩu không để trống.",
                "password.min"=>"Mật khẩu tối thiểu 8 ký tự.",
            ]
        );
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])
            // || Auth::attempt(['phone_number' => $request->email, 'password' => $request->password])
        ){
            // return redirect(route('homepage'));
            $request->session()->get('auth');
            $request->session()->put('auth',$request->email);
            $user = Auth::user();
            if($user->role == 100){
                $user->assignRole('admin');
                $user->givePermissionTo('admin public');
                notify()->success('Đăng nhập thành công!');
                return redirect('/');
            }
            else if($user->role == 10){
                $user->assignRole('user');
                notify()->success('Đăng nhập thành công!');
                return redirect('/');
            }
            else{
                notify()->success('Đăng nhập thành công!');
                $user->assignRole('member');
                return redirect('/');
            }
        }
        $msg = "Tài khoản hoặc mật khẩu không đúng!";
        return view('frontend.login-member',compact('msg'));
    }
    public function Register(SignUpForm $request){
        $confirmation_code = time().uniqid(true);
        $model = new User();
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->image = asset('auth/user-male.png');
        $model->confirmation_code = $confirmation_code;
        $model->save();
        Mail::send('email.verify',['confirmation_code'=>$confirmation_code], function($message) use ($request) {
            $message->from('theanh11220011@gmail.com');
            $message->to($request->email);
            $message->subject('Verify your email address');
        });
        $notification_status = 'Vui lòng xác nhận tài khoản email';
        return view('frontend.login-member',compact('notification_status'));
    }
    public function verify($code)
    {
        $user = User::where('confirmation_code', $code);
        if ($user->count() > 0) {
            $user->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);
            $notification_status = 'Bạn đã xác nhận thành công';
        } else {
            $notification_status ='Mã xác nhận không chính xác';
        }
        return view('frontend.login-member',compact('notification_status'));
    }
    public function authenticate(AuthForm $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if (!Auth::attempt($credentials)) {
            return redirect()->back()
                ->withErrors([
                    'email'  =>  'Bạn không thể đăng nhập'
                ]);
        }
        return redirect('/');
    }
}
