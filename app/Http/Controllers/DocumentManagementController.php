<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentManagement\Store as StoreRequest;
use App\Http\Requests\DocumentManagement\Update as UpdateRequest;
use App\Mail\DocumentManagementToMail;
use App\Repositories\Eloquent\DocumentManagementRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        return view('pages.index-document')->with([
            'documents' => $this->documentManagementModel->all($request->all())
        ]);
    }

    /**
     * Display the create form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.add-document');
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
            $document = $this->documentManagementModel->store($request->all());
            DB::commit();
            return redirect()->route('document-managements.show', $document->id);
        } catch(\Exception $e){
            report($e);
            DB::rollback();
            return back()->withErrors(['Proses data gagal, silahkan coba lagi'])->withInput();
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
        return view('pages.show-document')->with([
            'document' => $this->documentManagementModel->find($id)
        ]);
    }

    /**
     * Display the edit form.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('pages.edit-document')->with([
            'document' => $this->documentManagementModel->find($id)
        ]);
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
            $document = $this->documentManagementModel->update($id, $request->all());
            DB::commit();
            return redirect()->route('document-managements.show', $document->id);
        } catch(\Exception $e){
            report($e);
            DB::rollback();
            return back()->withErrors(['Proses data gagal, silahkan coba lagi'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->documentManagementModel->delete($id);
            return redirect()->route('document-managements.index');
        } catch(\Exception $e){
            report($e);
            DB::rollback();
            return back()->withErrors(['Proses data gagal, silahkan coba lagi']);
        }
    }

    /**
     * Sent to mail the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendToMail(Request $request, $id)
    {
        try{
            $document = $this->documentManagementModel->find($id);
            Mail::to($request->user())->send(new DocumentManagementToMail($document));
            return redirect()->route('document-managements.index');
        } catch(\Exception $e){
            report($e);
            DB::rollback();
            return back()->withErrors(['Proses data gagal, silahkan coba lagi']);
        }
    }
}
