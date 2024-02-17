<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tSYS_IngeniousImportOrderQueue_bckp;

class ImportOrderQueueBackupController extends Controller
{
    public function index(){
        $allBackupQueues = tSYS_IngeniousImportOrderQueue_bckp::all();
        $data = [
            "message" => "Retrieved all the backup queues",
            "backupQueues" => $allBackupQueues,
        ];

        return response()->json($data);
    }
}
