<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    private $userModel;
  
    public function __construct(UserRepository $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        DB::beginTransaction();
		try{
            $user = $this->userModel->store($request->all());
            DB::commit();
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        } catch(\Exception $e){
            report($e);
            DB::rollback();
            return back()->withErrors(['Proses data gagal, silahkan coba lagi'])->withInput();
        }

    }
}
