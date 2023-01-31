<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{
   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
    public function __construct(User $model)
    {
       parent::__construct($model);
    }

    /**
    * @param $request
    *
    * @return Void
    */
    public function doLogin($request)
    {
      $request->authenticate();
      $request->session()->regenerate();
    }

    /**
    * @param $request
    *
    * @return Void
    */
    public function doLogout($request)
    {
      Auth::guard('web')->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
    }
}