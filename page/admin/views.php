<?php
require("../controller/Admin.php");
// Fetch data from the admin table
$admins = Index("SELECT * FROM admin");
?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="columns">
                <div class="column">
                    <div>
                        <div class="card-header">
                            <p class="card-header-title">Daftar Admin</p>
                            <div class="buttons card-header-icon">
                                <a class="button is-link" href="index.php?halaman=tambahadmin">
                                    Tambah Admin
                                </a>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="table-container">
                                <table class="table is-fullwidth">
                                    <thead class="has-background-success">
                                        <tr>
                                            <th class="has-text-white">No</th>
                                            <th class="has-text-white">Nama Lengkap</th>
                                            <th class="has-text-white">Username</th>
                                            <th class="has-text-white">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($admins as $admin) : ?>
                                            <tr>
                                                <th><?= $i++ ?></th>
                                                <td><?= $admin["nm_lengkap"] ?></td>
                                                <td><?= $admin["username"] ?></td>
                                                <td>
                                                    <div class="buttons">
                                                        <a class="button is-link" href="index.php?halaman=editadmin&id=<?= $admin['id_admin']; ?>">
                                                            <ion-icon name="create"></ion-icon>
                                                        </a>
                                                        <button class="button is-danger" onclick="DeleteData()">
                                                            <ion-icon name="trash"></ion-icon>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function DeleteData() {
        // event.preventDefault(); // prevent form submit
        Swal.fire({
            title: 'Yakin mau hapus data ini?',
            text: "kalo sudah dihapus, tidak bisa dibalikin ya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#276CDA',
            cancelButtonColor: '#F03A5F',
            confirmButtonText: 'Iya, hapus aja',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "index.php?halaman=hapusadmin&id=<?= $admin['id_admin']; ?>";
            }
        })
    }
</script>