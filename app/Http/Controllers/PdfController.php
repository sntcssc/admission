<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Application;

class PdfController extends Controller
{
    public function generateApplicationPdf(Application $application)
    {
        $pdf = PDF::loadView('pdf.application', [
            'application' => $application->load('student', 'documents', 'payments')
        ]);
        
        return $pdf->download("application-{$application->id}.pdf");
    }
}
