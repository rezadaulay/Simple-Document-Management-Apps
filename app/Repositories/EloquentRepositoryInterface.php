<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
// use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\BaseResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
   /**
    * @param array $params
    * @return LengthAwarePaginator
    */
   public function all(array $params = []): LengthAwarePaginator;

   /**
    * @param array $inputs
    * @return Model
    */
    public function store(array $inputs): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find(string $id): ?Model;

   /**
    * @param $id
    * @param $inputs
    * @return Model
    */
    public function update(string $id, array $inputs): Model;

    /**
     * @param $id
     * @param $request
     * @return Void
     */
     public function delete(string $id);
}
