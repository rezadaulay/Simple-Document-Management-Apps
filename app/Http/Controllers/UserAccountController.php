<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAccountController extends Controller
{
    private $userModel;
  
    public function __construct(UserRepository $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Display the account view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('pages.account-detail');
    }

    /**
     * Display the form account view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.update-account');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\UpdateAccountRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UpdateAccountRequest $request)
    {
        DB::beginTransaction();
		try{
            $this->userModel->update(Auth::id(), $request->all());
            DB::commit();
            return redirect()->route('account');
        } catch(\Exception $e){
            report($e);
            DB::rollback();
            return back()->withErrors(['Proses data gagal, silahkan coba lagi'])->withInput();
        }

    }
}
