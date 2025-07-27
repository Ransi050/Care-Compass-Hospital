<?php
include ('./DB_Connect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $disease = $_POST['disease'];
    $date = $_POST['date'];
    
   
    $fileDestination = NULL;
    
   
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
        
      
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($fileError === 0) {
            if ($fileExt !== 'pdf') {
                echo "File must be a PDF.";
                exit();
            }

           
            $uploadDir = '../reports/';
            $fileDestination = $uploadDir . basename($fileName);
            if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                echo "Error uploading file.";
                exit();
            }
        } else {
            echo "Error with file upload.";
            exit();
        }
    }

    $sql = "INSERT INTO medical_records (email, disease, date, document) 
            VALUES ('$email', '$disease', '$date', '$fileDestination')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $conn->close();
}
?>
