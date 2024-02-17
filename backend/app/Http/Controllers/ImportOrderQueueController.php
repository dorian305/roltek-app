<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tSYS_IngeniousImportOrderQueue;

class ImportOrderQueueController extends Controller
{
    public function index(){
        $allQueues = tSYS_IngeniousImportOrderQueue::all();
        $data = [
            "message" => "Retrieved all the queues",
            "queues" => $allQueues,
        ];

        return response()->json($data);
    }

    public function filter(Request $request){
        $filters = $request->json('filters');

        // Query builder
        $query = tSYS_IngeniousImportOrderQueue::query();

        foreach ($filters as $column => $value){
            if ($value != ""){
                $query->where($column, 'like', "%$value%");
            }
        }

        $filteredOrders = $query->get();
        $data = [
            "message" => "Retrieved filtered orders",
            "orders" => $filteredOrders,
        ];

        return response()->json($data);
    }
}
