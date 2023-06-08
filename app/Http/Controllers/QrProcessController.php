<?php

namespace App\Http\Controllers;


use Response;
use Illuminate\Http\Request;
use setasign\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use PDFWatermark;



class QrProcessController extends Controller
{
    public function showpdf()
    {
//        $pdfPath = public_path().'/'.Storage::url('public/files/1.pdf');
        $pdfPath = public_path().'/'.Storage::url('public/files/1.pdf');
        return view('pdf-reader',compact('pdfPath'));
//        return response()->file($pdfPath);
    }

    public function instertQrCode2()
    {
        //Specify path to image. The image must have a 96 DPI resolution.
        $watermark = new PDFWatermark('C:\myimage.png');

//Set the position
        $watermark->setPosition('bottomleft');

//Place watermark behind original PDF content. Default behavior places it over the content.
        $watermark->setAsBackground();

//Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
        $watermarker = new PDFWatermarker('C:\test.pdf','C:\output.pdf',$watermark);

//Set page range. Use 1-based index.
        $watermarker->setPageRange(1,5);

//Save the new PDF to its specified location
        $watermarker->savePdf();
    }
    public function insertQrCode()
    {
        // Đường dẫn tới file PDF ban đầu
//        $pdfPath = public_path('files\1.pdf');
        $pdfPath = public_path().'/'.Storage::url('public/files/1.pdf');
        // Tạo đối tượng Fpdi và nạp file PDF
        $pdf = new Fpdi\Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($pdfPath);
        $templateId = $pdf->importPage(1);
        $pdf->useTemplate($templateId);

        // Tạo mã QR code
        $qrCode = QrCode::generate('https://example.com');

        // Lấy đường dẫn tới file ảnh QR code tạm thời
        $qrCodePath = public_path('files/qrcode.png');
        $qrCode->writeFile($qrCodePath);

        // Chèn ảnh QR code vào file PDF
        $pdf->Image($qrCodePath, 10, 10, 50, 0, 'PNG');

        // Lưu file PDF đã chèn mã QR code
        $outputPath = public_path('files/modified.pdf');
        $pdf->Output($outputPath, 'F');

        // Xóa file ảnh QR code tạm thời
        unlink($qrCodePath);

        return response()->download($outputPath);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
