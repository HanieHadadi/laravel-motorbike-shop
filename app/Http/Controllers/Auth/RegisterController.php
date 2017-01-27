<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        if(get_class($user) != 'App\User'){
            return ($user);
        }

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        /* @var $val \Illuminate\Contracts\Validation\Validator */

        $userModel =  User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                ]);
        if($userModel){
            try{
                $userModel->roles()->sync([Role::ROLE_MEMBER]);
                return $userModel;
            }catch (\Illuminate\Database\QueryException $ex){

                $val = Validator::make(Input::all(), []);
                $val->getMessageBag()->add('role','cannt register as member');
                $userModel->delete();
                return Redirect::back()->withErrors($val)->withInput();

            }
        }
        $val = Validator::make(Input::all(), []);
        $val->getMessageBag()->add('insert','user doesnt registered please try later');
        return Redirect::back()->withErrors($val)->withInput();

    }
}
