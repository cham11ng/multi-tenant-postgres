<?php

namespace App\Http\Controllers\Auth;

use App\Http\Facades\PGSchema;
use App\Tenant;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request as RegisterRequest;
use Illuminate\Support\Facades\Request as Request;
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
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     * Overriding register method prevent creating user session
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name'     => 'required|string|max:255|unique:tenants',
                'email'    => 'required|string|email|max:255|unique:tenants',
                'password' => 'required|string|min:6|confirmed',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $response = Tenant::create(
            [
                'name'       => $data['name'],
                'schema'     => $data['name'],
                'sub_domain' => $data['name'],
                'email'      => $data['email'],
            ]
        );

        PGSchema::install($response->schema, ['--path' => 'database/migrations/tenant']);

        $this->redirectTo = Request::getScheme() . '://' . $response->sub_domain . '.' . config('app.url');

        return User::create(
            [
                'name'     => $data['name'],
                'email'    => $data['email'],
                'role_id'  => 1,
                'password' => bcrypt($data['password']),
            ]
        );
    }
}
