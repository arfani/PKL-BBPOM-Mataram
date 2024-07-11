<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Check if file was uploaded
    if (isset($_FILES['surat_balasan']) && $_FILES['surat_balasan']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['surat_balasan']['tmp_name'];
        $fileName = $_FILES['surat_balasan']['name'];
        $fileSize = $_FILES['surat_balasan']['size'];
        $fileType = $_FILES['surat_balasan']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $uploadFileDir = './Asset/Document/';
        $dest_path = $uploadFileDir . $newFileName;

        // Check if the uploads directory exists
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        // Move the uploaded file to the server
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Update the database
            $sql = "UPDATE pengajuan_pkl SET surat_balasan = ? WHERE id_pengajuan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $dest_path, $id);

            if ($stmt->execute()) {
                $message = 'File is successfully uploaded and database is updated.';
            } else {
                $message = 'There was some error in updating the database.';
            }

            $stmt->close();
        } else {
            $message = 'There was some error moving the file to the upload directory.';
        }
    } else {
        $message = 'There is some error in the file upload. Please check the file and try again.';
    }
} else {
    $message = 'Invalid request method.';
}

// Redirect back to the admin page with a message
header("Location: admin.php?message=" . urlencode($message));
exit();
