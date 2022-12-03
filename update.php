<?php 
    // connect data ke database
    include("db_connect.php");

    // mengambil id dari URL dan mengambil data dari id tersebut
    if(isset($_GET['id'])){
        $id = $conn->real_escape_string($_GET["id"]);
        $sql = "SELECT id, name, npm, jenis_kelamin, image FROM mahasiswa WHERE id=".$id;
        $result = $conn->query($sql);
        $student = $result->fetch_assoc();
        $result->free_result();
        $conn->close();
    }
    
    // mengambil data dari form yang memiliki button submit bernama update
    if(isset($_POST['update'])){
        // membuat variabel dari setiap data yang ada di form
        $id_to_update = $conn->real_escape_string($_POST['update']);
        $name = $conn->real_escape_string($_POST['name']);
        $npm = $conn->real_escape_string($_POST['npm']);
        $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);

        // membuat link dari gambar yang kita upload
        $filename = $_FILES['image']["name"];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $new_name = date('YmdHis');
        $tempname = $_FILES['image']['tmp_name'];
        $folder = "./images/".$name.".".$extension;
        
        // mengupload gambar. jika ada gambar maka akan mengupdate data gambar, jika tidak maka kita tidak akan mengupdate data gambar
        if(move_uploaded_file($tempname, $folder)){
            $sql = "UPDATE mahasiswa SET name='$name', npm=$npm, jenis_kelamin='$jenis_kelamin', image='$folder' WHERE id=$id_to_update";
        } else {
            $sql = "UPDATE mahasiswa SET name='$name', npm=$npm, jenis_kelamin='$jenis_kelamin' WHERE id=$id_to_update";
        }
        $result = $conn->query($sql);

        // menjalankan query
        if($result) {
            // jika query berhasil maka akan diarahkan ke page index.php
            header('Location: index.php');
        } else {
            echo "error";
        }
    }
    
    // ini function untuk menceklis opsi jenis kelamin di radio button. jika kita menambahkan attribute "checked" maka opsi tersebut sudah tercentang.
    function cek_jenis_kelamin($data, $jenis_kelamin){
        if($jenis_kelamin == $data) {
            return "checked";
        }    
    }
?>

<html>
    <head>
        <title>Update data</title>
    </head>
    <body>
        <h1>Update</h1>
         <form method="POST" action="update.php" enctype="multipart/form-data">
            <label>Nama</label>
            <br>
            <!-- menambahkan attribute value yang nilainya dari database. jadi nanti di input formnya langsung terisi nilai -->
            <input type="text" name="name" value=<?php echo $student['name']; ?> >
            <br>
            <label>NPM</label>
            <br>
            <input type="text" name="npm" value=<?php echo $student['npm']; ?> >
            <br>
            <label>Jenis Kelamin<label>
            <br>
            <!-- menambahkan function yang tadi dibuat untuk ceklis input jenis_kelamin -->
            <input type="radio" name="jenis_kelamin" value="laki-laki" <?php echo cek_jenis_kelamin($student["jenis_kelamin"], "laki-laki"); ?>
> Laki-laki
            <input type="radio" name="jenis_kelamin" value="perempuan" <?php echo cek_jenis_kelamin($student["jenis_kelamin"], "perempuan"); ?>> Perempuan
            <br>
            <label>Foto wajah</label>
            <br>
            <input type="file" name="image">
            <br>
            <br>
            <button type="submit" name="update" value=<?php echo $student["id"]; ?>>Submit</button>
        </form>
    </body>
</html>