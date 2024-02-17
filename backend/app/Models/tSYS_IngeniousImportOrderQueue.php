<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tSYS_IngeniousImportOrderQueue extends Model
{
    protected $table = 'tSYS_IngeniousImportOrderQueue';
    protected $primaryKey = 'anID';
    protected $fillable = [
        'anID',
        'acOID',
        'acDokumentenNr',
        'anIDStatus',
        'anPriority',
        'addateInserted',
        'addateUpdated',
        'anIDTaskType',
    ];
}
