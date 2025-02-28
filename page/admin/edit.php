<?php
require("../controller/Admin.php");

// Check if the form is submitted
if (isset($_POST["add"])) {
    if (editAdmin($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil diupdate',
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
                text: 'Data gagal diupdate',
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
}

// Fetch the admin data based on the provided ID
$id = $_GET["id"];
$admin = Index("SELECT * FROM admin WHERE id_admin = $id")[0];
?>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">Form Edit Admin</p>
                            <div class="buttons card-header-icon">
                                <a class="button is-link" href="index.php?halaman=dataadmin">
                                    <ion-icon name="arrow-back-circle" class="mr-2"></ion-icon>Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-content">
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $admin["id_admin"] ?>">
                                <div class="field">
                                    <label class="label">Nama Lengkap</label>
                                    <div class="control">
                                        <input class="input" type="text" name="nm_lengkap" value="<?= $admin["nm_lengkap"] ?>" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Username</label>
                                    <div class="control">
                                        <input class="input" type="text" name="username" value="<?= $admin["username"] ?>" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Password</label>
                                    <div class="control">
                                        <input class="input" type="password" name="password" value="<?= $admin["password"] ?>" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <button class="button is-link" type="submit" name="add">
                                        <ion-icon name="save" class="mr-2"></ion-icon>Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>