<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
        // バリデーションルールに適合しない場合、このメソッドには到達しません。
        // バリデーションルールに適合する場合、このメソッド内でユーザー情報を更新します。
        // バリデーションルールの定義
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|max:255', // パスワードはnullableに変更
        'image' => 'required|image', // 画像が必須であることを示すバリデーションルール
    ];

    // カスタムエラーメッセージの定義
    $messages = [
        'name.required' => '(注）名前を入力してください。',
        'email.required' => '（注）メールアドレスを入力してください。',
        'password.required' => '（注）パスワードを入力してください。',
        'image.required' => '（注）画像を選択してください。',
        // 他のエラーメッセージも必要に応じて追加する
    ];

    // バリデーション実行
    $validator = Validator::make($request->all(), $rules, $messages);

    // バリデーションが失敗した場合
    if ($validator->fails()) {
        return redirect('/register') // バリデーションエラーが発生した際のリダイレクト先を指定します
            ->withErrors($validator) // エラーメッセージをセッションに保存します
            ->withInput(); // 入力値をセッションに保存します
    }

    // バリデーションを通過した場合、以下の処理を実行
    $user = $request->user();

    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

