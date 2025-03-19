<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;

class KTAController extends Controller
{
    public function download($id) {

        $member = Member::findOrFail($id);

        $pdf = Pdf::loadView('test', compact('member'))->setPaper('a4', 'landscape');

        return $pdf->download('KTA_' . $member->owner_name . '.pdf');
    }
}
