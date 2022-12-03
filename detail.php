<?php
    // koneksi ke database
    include('db_connect.php');
    
    // check jika ada id pada URLnya. Jika ada, maka kode ini akan dijalankan 
    if(isset($_GET['id'])){
        // ambil id dari link
        $id= $conn->real_escape_string($_GET['id']);
        // melakukan query data yang memiliki id tertentu
        $sql = "SELECT id, name, npm, jenis_kelamin, image FROM mahasiswa WHERE id=".$id;
        $result = $conn->query($sql);
        // mengubah data menjadi associated array
        $student = $result->fetch_assoc();
        $result->free_result();
        $conn->close();
    }

    // check jika button delete diklik
    if(isset($_POST['delete'])){
        // ambil value yang dibawa oleh button delete
        $id_to_delete= $conn->real_escape_string($_POST['delete']);
        // delete data dengan id tertentu
        $sql = "DELETE FROM mahasiswa WHERE id=".$id_to_delete;
        $result = $conn->query($sql);

        if($result){
            // jika query sukses dijalankan maka kita akan diarahkan ke page index.php
            header('Location: index.php');
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

?>

<html>
    <head>
        <title>Detail</title>
    </head>
    <body>
        <h1>Detail</h1>
        <ul>
            <li><?php echo $student['id']; ?></li>
            <li><?php echo $student['name']; ?></li>
            <li><?php echo $student['npm']; ?></li>
            <li><?php echo $student['jenis_kelamin']; ?></li>
        </ul>
        <!-- check jika ada link gambar. jika ada maka akan memunculkan tag img -->
        <?php if($student["image"]) {
            echo "<img src= ".$student['image']. " width='200' >";
        }?>
        <form action="detail.php" method="POST">
        <!-- button ini kita namakan delete dan mengandung nilai id yang akan dimasukkan ke dalam query -->        
            <button type="submit" name="delete" value=<?php echo $student['id']; ?>>Delete</button>
            <!-- kita buat link khusus ke page update dengan membawa id data yang akan diupdate -->        
            <a href=<?php echo "update.php?id=".$student['id']; ?>>Update data</a>       
        </form>
    </body>
</html>