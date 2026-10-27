<?php
// Konfigurasi upload
$upload_path = './assets/uploads/';
$allowed_types = ['pdf']; // Hanya izinkan PDF
$max_size = 2048 * 1024; // 2MB dalam byte



// Cek apakah ada file yang diunggah
if (!isset($_FILES['dokumen'])) {
    echo "No file uploaded.";
    exit;
}

// Cek ukuran file
if ($_FILES['dokumen']['size'] > $max_size) {
    echo "File size exceeds the maximum limit of 2MB.";
    exit;
}

// Cek ekstensi file
$file_extension = strtolower(pathinfo($_FILES['dokumen']['name'], PATHINFO_EXTENSION));
if (!in_array($file_extension, $allowed_types)) {
    echo "Invalid file type. Only PDF files are allowed.";
    exit;
}

// Pastikan direktori upload ada
if (!is_dir($upload_path)) {
    mkdir($upload_path, 0755, true);
}

// Pindahkan file ke folder upload
$destination = $upload_path . basename($_FILES['dokumen']['name']);
if (move_uploaded_file($_FILES['dokumen']['tmp_name'], $destination)) {
    echo "File uploaded successfully: " . $destination;
} else {
    echo "Failed to upload file.";
}
?>


