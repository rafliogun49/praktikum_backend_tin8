<?php 
// ini kode buat koneksiin php ke database
include("db_connect.php");

// ini buat bikin tabel database (cukup dijalanin sekali aja)
// $sql = "CREATE TABLE mahasiswa (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// name VARCHAR(30) NOT NULL,
// npm INT(30) NOT NULL,
// jenis_kelamin VARCHAR(50),
// image VARCHAR(50),
// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// if($conn->query($sql) === TRUE){
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }


//ini buat masukin data ke database (cukup dijalanin sekali aja) 
// $sql = "INSERT INTO mahasiswa (name, npm, jenis_kelamin, image) VALUES ('nap', 23, 'laki-laki', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fqwebmaster.com%2Fwp-content%2Fuploads%2F2015%2F12%2Fphp-logo-1000x1000.png&f=1&nofb=1&ipt=eb48cd19515af29e6af9451e34457b0efd61c70674bccc3a22bc12d258f62636&ipo=images') ";

// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// ini buat ngambil data dari database
$sql = "SELECT id, name, npm, jenis_kelamin, image, reg_date FROM mahasiswa";
$result = $conn->query($sql);

// semua data bakal disimpan dalam bentuk associated array di variabel $students
$students = $result->fetch_all(MYSQLI_ASSOC);
?>

<html>
<head>
  <title>Tugas</title>
</head>
<body>
  <!-- fungsi di bawah ini buat looping data dari $students -->
  <?php foreach($students as $student): ?>
  <!-- ketika elemen ini diklik akan diarahkan ke page detail dengan membawa id pada URLnya -->
  <a href=<?php echo "detail.php?id=". $student['id']; ?>>
    <div style="border: 1px solid #000;">
      <p><?php echo $student['name'] . " " . $student['npm']; ?></p>
      <!-- ini buat check link imagenya. jika tidak ada link menuju gambar, maka kode ini tidak akan dijalankan -->
      <?php if($student["image"]) {
        echo "<img src= ".$student['image']. " width='200' >";
      }?>
    </div>
  </a>
  <?php endforeach; ?>
  <br>
  <a href="add.php">Add data</a>
</body>
</html>