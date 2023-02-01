<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DocumentManagementCollection;
use App\Http\Resources\DocumentManagementResource;
use App\Http\Requests\DocumentManagement\Store as StoreRequest;
use App\Http\Requests\DocumentManagement\Update as UpdateRequest;
use App\Repositories\Eloquent\DocumentManagementRepository;
use Illuminate\Support\Facades\DB;

class DocumentManagementController extends Controller
{
    private $documentManagementModel;
  
    public function __construct(DocumentManagementRepository $documentManagementModel)
    {
        $this->documentManagementModel = $documentManagementModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		try{
            return new DocumentManagementCollection($this->documentManagementModel->all($request->all()));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return response()->json([
				'errors' => 'Data not found',
			], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
			return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch(\Exception $e){
			report($e);
			return response()->json([
				'errors' => 'Proses data gagal, silahkan coba lagi',
			], $e->getCode() == 0 ? 500 : ($e->getCode() != 23000 ? $e->getCode() : 500));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DocumentManagement\Store as StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        DB::beginTransaction();
		try{
            $data = $this->documentManagementModel->store($request->all());
            DB::commit();
            return new DocumentManagementResource($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
			return response()->json([
				'errors' => 'Data not found',
			], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
			return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch(\Exception $e){
            report($e);
            DB::rollback();
			return response()->json([
				'errors' => 'Proses data gagal, silahkan coba lagi',
			], $e->getCode() == 0 ? 500 : ($e->getCode() != 23000 ? $e->getCode() : 500));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = $this->documentManagementModel->find($id);
            return new DocumentManagementResource($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
			return response()->json([
				'errors' => 'Data not found',
			], 404);
        } catch(\Exception $e){
            report($e);
            DB::rollback();
			return response()->json([
				'errors' => 'Proses data gagal, silahkan coba lagi',
			], $e->getCode() == 0 ? 500 : ($e->getCode() != 23000 ? $e->getCode() : 500));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DocumentManagement\Update as UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
		try{
            $data = $this->documentManagementModel->update($id, $request->all());
            DB::commit();
            return new DocumentManagementResource($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
			return response()->json([
				'errors' => 'Data not found',
			], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
			return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch(\Exception $e){
            report($e);
            DB::rollback();
			return response()->json([
				'errors' => 'Proses data gagal, silahkan coba lagi',
			], $e->getCode() == 0 ? 500 : ($e->getCode() != 23000 ? $e->getCode() : 500));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            $data = $this->documentManagementModel->delete($id);
			return response()->json($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
			return response()->json([
				'errors' => 'Data not found',
			], 404);
        } catch(\Exception $e){
            report($e);
            DB::rollback();
			return response()->json([
				'errors' => 'Proses data gagal, silahkan coba lagi',
			], $e->getCode() == 0 ? 500 : ($e->getCode() != 23000 ? $e->getCode() : 500));
        }
    }
}
