<?php

namespace App\Http\Controllers;

use App\Models\Timesheed;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class Pdfcontroller extends Controller
{
    public function TimesheedRecords (User $user){
        $timesheets = Timesheed::where('user_id', $user->id)->get();
        $pdf = Pdf::loadView('pdf.asistencia',['timesheets'=>$timesheets]);
        $name = Uuid::uuid4()->toString();
        return $pdf->download("$name.pdf");
    }
}
