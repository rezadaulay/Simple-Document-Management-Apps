<?php

namespace App\Repositories\Eloquent;

use App\Models\DocumentManagement;

class DocumentManagementRepository extends BaseRepository
{
   /**
    * DocumentManagementRepository constructor.
    *
    * @param DocumentManagement $model
    */
    public function __construct(DocumentManagement $model)
    {
       parent::__construct($model);
    }
}