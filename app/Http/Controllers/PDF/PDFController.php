<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function downloadPDF($id)
    {
        $post = Post::findOrFail($id);

        $pdf = Pdf::loadView('pdfs.post', compact('post'));
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->download('post_' . $post->id . '.pdf');
    }

    public function downloadTermsPDF()
    {
        $pdf = Pdf::loadView('pdfs.terms');

        return $pdf->download('terminos_y_condiciones.pdf');
    }
}
