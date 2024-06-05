<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Pastikan body dan html memiliki tinggi 100% */
    html, body {
      height: 80%;
      margin: 0;
    }
    
    /* Wrapper untuk konten */
    .content {
      min-height: 80%; /* Setidaknya setinggi 100% */
      display: flex;
      flex-direction: column;
    }

    /* Footer tetap di bagian bawah */
    .footer {
      margin-top: auto; 
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="content">
    <!-- Konten halaman -->
    <div class="main-content">
      <!-- Tambahkan konten utama Anda di sini -->
    </div>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>SidangPA</span></strong>. All Rights Reserved
      </div>
    </footer>
    <!-- End Footer -->
  </div>
</body>
</html>
