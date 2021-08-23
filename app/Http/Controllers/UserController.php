<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthForm;
use App\Http\Requests\UserForm;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('backend.users.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserForm $request)
    {
        //
        $confirmation_code = time().uniqid(true);
        $model = new User();
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->image = asset('auth/user-male.png');
        $model->role = 10;
        $model->confirmation_code = $confirmation_code;
        $model->save();
        Mail::send('email.staffverify',['confirmation_code'=>$confirmation_code], function($message) use ($request) {
            $message->from('theanh11220011@gmail.com');
            $message->to($request->email);
            $message->subject('Verify your email address');
        });
//        $notification_status = 'Vui lòng xác nhận tài khoản email';
        return redirect()->back()->with('success','Tạo tài khoản thành công!');

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

        return view('auth.login',compact('notification_status'));
    }

    public function authenticate(Request $request)
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $user = User::find($id);
        if($user->role == 100){
            return redirect()->back()->with('error','Không được xoá tài khoản Admin.');
        }
        else{
            $id_user = $user->id;
            $permission = Permission::where('model_id',$id_user);
            if($permission->count() > 0){
                $permission->delete();
            }
            $role = Role::where('model_id',$id_user);
            if($role->count() > 0){
                $role->delete();
            }
            User::find($id_user)->delete();
            return redirect()->back()->with('success','Xoá tài khoản thành công!');
        }
    }
}
