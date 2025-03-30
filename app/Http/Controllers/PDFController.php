<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function downloadPDF($id)
    {
        $post = Post::findOrFail($id);

        $pdf = Pdf::loadView('pdfs.post', compact('post'));

        return $pdf->download('post_' . $post->id . '.pdf');
    }

    public function downloadTermsPDF()
    {
        $pdf = Pdf::loadView('pdfs.terms');

        return $pdf->download('terminos_y_condiciones.pdf');
    }
}
