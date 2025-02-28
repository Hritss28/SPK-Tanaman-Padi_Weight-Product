<?php
if (isset($_GET['halaman'])) {
    $halaman = $_GET['halaman'];

    switch ($halaman) {
        case 'home':
            include "home/index.php";
            break;
        case "dataadmin":
            include "admin/views.php";
            break;
        case "tambahadmin":
            include "admin/add.php";
            break;
        case "editadmin":
            include "admin/edit.php";
            break;
        case "hapusadmin":
            include "admin/delete.php";
            break;
        case 'datales':
            include "les/views.php";
            break;
        case 'tambahdatales':
            include "les/add.php";
            break;
        case 'editdatales':
            include "les/edit.php";
            break;
        case 'hapusdatales':
            include "les/delete.php";
            break;
        case 'datakriteria':
            include "kriteria/views.php";
            break;
        case 'tambahdatakriteria':
            include "kriteria/add.php";
            break;
        case 'editdatakriteria':
            include "kriteria/edit.php";
            break;
        case 'hapusdatakriteria':
            include "kriteria/delete.php";
            break;
        case 'databobot':
            include "perhitungan/views.php";
            break;
        case 'tambahdatabobot':
            include "perhitungan/add.php";
            break;
        case 'editdatabobot':
            include "perhitungan/edit.php";
            break;
        case 'hapusdatabobot':
            include "perhitungan/delete.php";
            break;
        case 'datapenilaian':
            include "nilai/views.php";
            break;
            // case 'editmhs':
            //     include "content/edit/editmhs.php";
            //     break;
            // case 'hapusmhs':
            //     include "content/hapus/hapusmhs.php";
            //     break;
            // case 'hapusmk':
            //     include "content/hapus/hapusmk.php";
            //     break;
            // default:
            //     include "source/error.php";
            //     break;
    }
} else {
    include "home/index.php";
}
