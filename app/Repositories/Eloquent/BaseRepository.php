<?php   

namespace App\Repositories\Eloquent;   

use App\Repositories\EloquentRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all(array $params = []): LengthAwarePaginator
    {
        $data = $this->model;
        foreach ($this->model->getFillable() as $fillable) {
            if (isset($params[$fillable]) && $fillable !== 'order' && !is_null($params[$fillable]) && $params[$fillable] !== '') {
                $data = $data->where($fillable, 'LIKE', '%' . $params[$fillable] . '%');
            }
        }

        if (isset($params['order']) && in_array($params['order'], $this->model->getFillable())) {
            $data = $data->orderBy($params['order'], isset($params['ascending']) && $params['ascending'] == 0 ? 'DESC' : 'ASC');
        } else {
            $data = $data->orderBy('created_at', 'ASC');
        }
        return $data->paginate(isset($params['limit']) ? $params['limit'] : 25);
    }
 
    /**
    * @param array $inputs
    *
    * @return Model
    */
    public function store(array $inputs): Model
    {
        $fills = [];
        foreach ($this->model->getFillable() as $fillable) {
            if ($fillable !== 'id' && (isset($inputs[$fillable]) && !is_null($inputs[$fillable]) && trim($inputs[$fillable]) !== '')) {
                if (in_array($fillable, $this->model->getFileFields()) && isset($inputs[$fillable]) && !is_null($inputs[$fillable]) && request()->hasFile($fillable)) {
                    $value = request()->file($fillable)->store('uploads/' . date('Y/m/d'));
                    $fills[$fillable] = $value;
                } else if (in_array($fillable, $this->model->getHashFields())) {
                    $fills[$fillable] = Hash::make($inputs[$fillable]);
                } else {
                    $fills[$fillable] = $inputs[$fillable];
                }
            }
        }
        $data = $this->model;
        if (count($fills)) {
            $data= $data->create($fills);
        }
        return $data;
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function find(string $id): ?Model
    {
        $data = $this->model->find($id);
        if (is_null($data)) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException;
        }
        return $data;
    }
 
    /**
    * @param $id
    * @param $inputs
    * @return Model
    */
    public function update(string $id, array $inputs): Model
    {
        $data = $this->find($id);
        $fills = [];
        foreach ($this->model->getFillable() as $fillable) {
            if (in_array($fillable, $this->model->getFileFields()) && isset($inputs[$fillable]) && !is_null($inputs[$fillable]) && request()->hasFile($fillable)) {
                if (!is_null($data->{$fillable})) {
                    Storage::delete($data->{$fillable});
                }
                $value = request()->file($fillable)->store('uploads/' . date('Y/m/d'));
                $fills[$fillable] = $value;
            } else if ($fillable !== 'id' && (isset($inputs[$fillable]) && !is_null($inputs[$fillable]) && trim($inputs[$fillable]) !== '')) {
                if (in_array($fillable, $this->model->getHashFields())) {
                    $fills[$fillable] = Hash::make($inputs[$fillable]);
                } else {
                    $fills[$fillable] = $inputs[$fillable];
                }
            }
        }
        if (count($fills)) {
            $data->update($fills);
        }
        return $data->refresh();
    }
 
    /**
    * @param $id
    *
    * @return Void
    */
    public function delete(string $id): Void
    {
        $data = $this->find($id);
        foreach ($this->model->getFillable() as $fillable) {
            if (in_array($fillable, $this->model->getFileFields())) {
                if (!is_null($data->{$fillable})) {
                    Storage::delete($data->{$fillable});
                }
            }
        }
        $data->delete();
    }
}