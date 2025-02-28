<?php
require("../controller/Admin.php");

$id = $_GET['id'];

if (deleteAdmin($id) > 0) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data admin berhasil dihapus',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then(function() {
            window.location.href = 'index.php?halaman=dataadmin';
        });
    </script>";
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Data admin gagal dihapus',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then(function() {
            window.location.href = 'index.php?halaman=dataadmin';
        });
    </script>";
}
?>