<head>
    <style>
        .pdf-container {
            width: 100%;
            height: 100%;
            overflow: auto;
        }
        .pdf-iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body>
{!! QrCode::size(100)->generate($pdfPath); !!}
<br>


<div class="row justify-content-center pdf-container" style="margin-top:50px">
        <iframe  class="pdf-iframe" src="{{ Storage::url('public/files/1.pdf') }}">
            This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('folder/file_name.pdf') }}">Download PDF</a>
        </iframe>
    </div>
</body>
