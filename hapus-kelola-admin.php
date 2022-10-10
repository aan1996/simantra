<?php
require 'include/function.php';

$id = $_GET['id'];
$hapus = mysqli_query($link, "DELETE FROM  user WHERE id='$id'");

if ($hapus) {
?>
    <script>
        alert("Data berhasil dihapus");
        window.location.href = "kelola-admin.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Data gagal dihapus");
        window.location.href = "kelola-admin.php";
    </script>
<?php
}

?>