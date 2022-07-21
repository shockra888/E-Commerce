<?php

namespace App\Http\Controllers\Auth;

use App\users;
use App\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
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
    protected $redirectTo = '/home';

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
            'Fname' => 'required',
            'Address' => 'required',
            'Phonenum' => 'required',
            'Gender' => 'required',
            'Email' => 'required',
            'Password' => 'required',
            'AccountType' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return users::create([
            'account_type' => $data['Account_Type'],
            'email' => $data['Email'],
            'password' => bcrypt($data['Password']),
        ]);

        $accntid = users::all()->toArray();

        return admin::create([
            'AccntID' => $data($accntid['id']),
            'Admin_Name' => $data('Fname'),
            'Admin_Address' => $data('Address'),
            'Admin_Contact#' => $data('Phonenum'),
            'Gender' => $data('Gender')
        ]);
    }
}
