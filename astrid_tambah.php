<?php 
    // connect database
    include("db.php");
    // kode ini akan dijalankan ketika user menekan button dengan name submit
    if(isset($_POST["submit"])){
        // membuat variabel yang berisi input dari form
        $Nama_Tempat= $conn->real_escape_string($_POST['Nama_Tempat']);
        $Rating = $conn->real_escape_string($_POST['Rating']);
        $Alamat = $conn->real_escape_string($_POST['Alamat']);
        $Tahun_Dibangun = $conn->real_escape_string($_POST['Tahun_Dibangun']);
        $Penjelasan = $conn->real_escape_string($_POST['Penjelasan']);
        //membuat alamat gambarnya
        $filename = $_FILES['Gambar']["name"];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $new_name = date('YmdHis');
        $tempname = $_FILES['Gambar']['tmp_name']; 
        $folder = "./img/".$new_name.".".$extension;
        echo $Nama_Tempat . $Rating . $Alamat . $Tahun_Dibangun . $Penjelasan . $folder;
        // melakukan upload gambar ke folder image
        // jika ada gambar yang diunggah maka kita akan memasukkan seluruh data
        // jika tidak ada gambar maka kita akan memasukkan seluruh data kecuali kolom image
        if(move_uploaded_file($tempname, $folder)){
            $sql = "INSERT INTO `koreantrip` (`id`, `Nama_Tempat`, `Alamat`, `Gambar`, `Rating`, `Tahun_Dibangun`, `Penjelasan`, `reg_date`) VALUES (NULL, '$Nama_Tempat', '$Alamat', '$folder', '$Rating', '$Tahun_Dibangun', '$Penjelasan', current_timestamp());";                
        } else {
            $sql = "INSERT INTO `koreantrip` (`id`, `Nama_Tempat`, `Alamat`, `Gambar`, `Rating`, `Tahun_Dibangun`, `Penjelasan`, `reg_date`) VALUES (NULL, '$Nama_Tempat', '$Alamat', '$folder', '$Rating', '$Tahun_Dibangun', '$Penjelasan', current_timestamp());";                
        // menjalankan query
        }

        $result = $conn->query($sql);
        if($result) {
            // jika query sukses maka akan diarahkan ke page rekomendasi.php
            header('Location: rekomendasi.php');
            // echo $Nama_Tempat . $Rating . $Alamat . $Tahun_Dibangun . $Penjelasan . $folder;
        } else {
            echo $conn->error;
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <!-- <nav class = "navbar">
        <ul>
            <li><a href="index.php" class="menu">Home</a></li>
            <li><a href="about.php" class="menu">About</a></li>
            <li><a href="#recommendationtrip"class = "menu">Contact</a></li>
        </ul>
    </nav> -->
    
    <div class="update-data">
        <div class="text-data"></div>
        <h1>Tambah</h1>
        <form method="POST" action="tambah.php" enctype="multipart/form-data">
            <label>Nama</label>
            <br>
            <input type="text" name="Nama_Tempat" >
            <br>
            <label>Rating</label>
            <br>
            <input type="number" name="Rating">
            <br>
            <label>Alamat<label>
            <br>
            <input type="text" name="Alamat" >
            <br>
            <label>Tahun Dibangun<label>
            <br>
            <input type="number" name="Tahun_Dibangun" >
            <br>
            <label>Gambar</label>
            <br>
            <input type="file" name="Gambar">
            <br>
            <label>Penjelasan</label>
            <br>
            <input type="text" name="Penjelasan">
            <br>
            <!-- button type submit ini berfungsi untuk submit form -->
            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
    </body>
<html>
