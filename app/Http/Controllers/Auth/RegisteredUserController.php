<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;
// use Cloudinary;
// use Illuminate\Support\Facades\Validator;
// use App\Models\Post;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Display the registration view.
//      */
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     /**
//      * Handle an incoming registration request.
//      *
//      * @throws \Illuminate\Validation\ValidationException
//      */
//     public function store(Request $request): RedirectResponse
//     {
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//             'image' => ['nullable', 'image'], // 画像のバリデーションを追加
//         ]);

//         $rules = [
//                 'image' => 'required|image', // 画像が必須であることを示すバリデーションルール
//             ];
        
//             // カスタムエラーメッセージの定義
//             $messages = [
//                 'image.required' => '画像を選択してください。',
//             ];
        
//             // バリデーション実行
//             $validator = Validator::make($request->all(), $rules, $messages);
        
//             // バリデーションが失敗した場合
//             if ($validator->fails()) {
//                 return redirect('/register') // バリデーションエラーが発生した際のリダイレクト先を指定します
//                     ->withErrors($validator) // エラーメッセージをセッションに保存します
//                     ->withInput(); // 入力値をセッションに保存します
//             }
        
//             $image_url = null; // 初期化
            
//             // 画像が送信されているか確認
//             if ($request->hasFile('image')) {
//                 // 画像の処理を行う
//                 $image = $request->file('image')->getRealPath();
//                 $upload = Cloudinary::upload($image)->getSecurePath();
//                 dd($image_url);
//             } else {
//                 $upload = null;
//             }
        
//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'image_url' => $image_url, // 画像のURLを保存
            
//         ]);

//         event(new Registered($user));

//         Auth::login($user);
        
         

//         return redirect(RouteServiceProvider::HOME);
//     }
// }

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Cloudinary;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image_url' => ['nullable', 'image'], // 画像のバリデーションを追加
        ]);

        // 初期化
        $image_url = null;
        
        // 画像が送信されているか確認
        if ($request->hasFile('image')) {
            // 画像の処理を行う
            $image = $request->file('image')->getRealPath();
            $upload = Cloudinary::upload($image)->getSecurePath();
            $image_url = $upload;
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image_url' => $image_url, // 画像のURLを保存
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        return redirect(RouteServiceProvider::HOME);
    }
}