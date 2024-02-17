<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tSYS_IngeniousImportOrderQueue_bckp extends Model
{
    protected $table = 'tSYS_IngeniousImportOrderQueue_bckp';
    protected $primaryKey = 'anID';
    protected $fillable = [
        'anID',
        'anIDQueue',
        'acOID',
        'acDokumentenNr',
        'anIDStatus',
        'anPriority',
        'acError',
        'addateInserted',
        'addateUpdated',
        'anIDTaskType',
    ];
}
