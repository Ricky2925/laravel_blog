<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.login')->only('showRegistrationForm');
    }

    // 显示注册表单
    public function showRegistrationForm()
    {
       
        return view('auth.register');
  
    }


    // 处理注册逻辑
    public function register(Request $request)
    {
        $messages = [
            'email.unique' => 'The email address is already taken by another user.',
        ];
        
       // 验证注册表单数据
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // 检查 email 唯一性
            'password' => ['required', 'string', 'min:8'],
        ],$messages );
        $user = $this->create($request->all());

        auth()->login($user);
        
        return redirect()->route('welcome');
       
    }

    // 自定义验证规则
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // 创建用户
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
