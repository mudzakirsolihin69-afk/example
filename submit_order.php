<?php
// Pastikan skrip hanya berjalan jika diakses melalui metode POST (formulir dikirim)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. SETTING PENERIMA EMAIL ---
    $email_tujuan = "mudzakirsolihin69@gmail.com"; // **PASTIKAN INI ADALAH EMAIL ANDA**
    $subjek = "PESANAN BARU B2B dari " . htmlspecialchars(trim($_POST['nama_toko']));

    // --- 2. AMBIL DAN BERSIHKAN DATA DARI FORMULIR ---
    $nama_toko = htmlspecialchars(trim($_POST['nama_toko']));
    $email_pengirim = htmlspecialchars(trim($_POST['email']));
    $telepon = htmlspecialchars(trim($_POST['telepon']));
    $pesan = htmlspecialchars(trim($_POST['pesan']));

    // --- 3. SUSUN ISI EMAIL ---
    $isi_email = "Anda mendapat permintaan pasokan B2B baru dari website.\n\n";
    $isi_email .= "======================================\n";
    $isi_email .= "DETAIL KONTAK:\n";
    $isi_email .= "Nama Toko/Usaha: " . $nama_toko . "\n";
    $isi_email .= "Email Kontak: " . $email_pengirim . "\n";
    $isi_email .= "Nomor Telepon: " . $telepon . "\n";
    $isi_email .= "--------------------------------------\n";
    $isi_email .= "PESAN/PERMINTAAN KHUSUS:\n";
    $isi_email .= $pesan . "\n";
    $isi_email .= "======================================\n";

    // --- 4. SUSUN HEADER EMAIL ---
    $headers = "From: " . $email_pengirim . "\r\n";
    $headers .= "Reply-To: " . $email_pengirim . "\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n"; 

    // --- 5. KIRIM EMAIL ---
    $email_terkirim = mail($email_tujuan, $subjek, $isi_email, $headers);

    // --- 6. REDIREKSI KE HALAMAN UTAMA SETELAH PENGIRIMAN ---
    if ($email_terkirim) {
        // Alihkan ke index.html, (Anda bisa membuat halaman 'terima kasih' terpisah)
        header("Location: index.html?status=success");
    } else {
        // Alihkan jika gagal (cek log server jika ini terjadi)
        header("Location: index.html?status=error");
    }
    exit;

} else {
    // Pencegahan akses langsung
    header("Location: index.html");
    exit;
}
?>