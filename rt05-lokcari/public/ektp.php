<h3>Integrasi e-KTP (Placeholder)</h3>
<p>Upload foto KTP atau gunakan webcam. (Implementasi OCR bisa dipasang dengan Tesseract di server)</p>
<form enctype="multipart/form-data" method="post">
<input type=file name=ktp><button>Scan</button>
</form>
<?php if($_FILES) echo "<pre>Upload sukses (belum OCR)</pre>"; ?>