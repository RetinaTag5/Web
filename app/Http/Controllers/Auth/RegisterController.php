<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
			'birthday' => 'required|string|max:255',
			'hometown' => 'required|string|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
		$hometown = '台灣';
		switch($data['hometown']){
			case 'tw': $hometown = '台灣'; break;
			case 'jp': $hometown = '日本'; break;
			case 'kr': $hometown = '韓國'; break;
			case 'eu': $hometown = '歐洲'; break;
			case 'usa': $hometown = '美國'; break;
			case 'oth': $hometown = '其他國家'; break;
			
		}
        return User::create([
            'name' => $data['name'],
			'birthday' => $data['birthday'],
			'hometown' => $hometown,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
