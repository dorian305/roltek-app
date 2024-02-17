<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tSYS_IngeniousImportOrderQueue_bckp;

class GetOrderStatusController extends Controller
{
    public function getOrderStatus($anID){
        $backupOrder = tSYS_IngeniousImportOrderQueue_bckp::where('anIDQueue', $anID)->first();

        $data = [
            "message" => "Retrieved the error",
            "orderBackup" => $backupOrder,
        ];

        return response()->json($data);
    }
}
