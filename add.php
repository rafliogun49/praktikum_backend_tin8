<?php 
    // connect database
    include("db_connect.php");
    // kode ini akan dijalankan ketika user menekan button dengan name submit
    if(isset($_POST["submit"])){
        // membuat variabel yang berisi input dari form
        $name = $conn->real_escape_string($_POST['name']);
        $npm = $conn->real_escape_string($_POST['npm']);
        $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
        //membuat alamat gambarnya
        $filename = $_FILES['image']["name"];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $new_name = date('YmdHis');
        $tempname = $_FILES['image']['tmp_name'];
        $folder = "./images/".$new_name.".".$extension;

        // melakukan upload gambar ke folder image
        // jika ada gambar yang diunggah maka kita akan memasukkan seluruh data
        // jika tidak ada gambar maka kita akan memasukkan seluruh data kecuali kolom image
        if(move_uploaded_file($tempname, $folder)){
            $sql = "INSERT INTO mahasiswa (name, npm, jenis_kelamin, image) VALUES ('$name', $npm, '$jenis_kelamin', '$folder')";        
        } else {
            $sql = "INSERT INTO mahasiswa (name, npm, jenis_kelamin) VALUES ('$name', $npm, '$jenis_kelamin')";
        } 
        // menjalankan query
        $result = $conn->query($sql);

        if($result) {
            // jika query sukses maka akan diarahkan ke page index.php
            header('Location: index.php');
        } else {
            echo "error";
        }

    }

?>

<html>
    <head>
        <title>Add</title>
    </head>
    <body>
        <h1>Add data</h1>
        <!-- Ini settingan untuk membuat form yang dapat mengupload gambar -->
        <form method="POST" action="add.php" enctype="multipart/form-data">
            <label>Nama</label>
            <br>
            <input type="text" name="name" >
            <br>
            <label>NPM</label>
            <br>
            <input type="text" name="npm" >
            <br>
            <label>Jenis Kelamin<label>
            <br>
            <!-- pastikan name dari opsinya sama agar dapat berfungsi -->
            <input type="radio" name="jenis_kelamin" value="laki-laki"> Laki-laki
            <input type="radio" name="jenis_kelamin" value="perempuan"> Perempuan
            <br>
            <label>Foto wajah</label>
            <br>
            <input type="file" name="image">
            <br>
            <br>
            <!-- button type submit ini berfungsi untuk submit form -->
            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
    </body>
<html>
