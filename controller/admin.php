<?php 
function Koneksi()
{
    return mysqli_connect("localhost", "root", "", "wpv2");
}

function Index($query)
{
    $koneksi = Koneksi();
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function addAdmin($data)
{
    $koneksi = Koneksi();
    $nm_lengkap = htmlspecialchars($data["nm_lengkap"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);

    $query = "INSERT INTO admin (nm_lengkap, username, password) VALUES ('$nm_lengkap', '$username', '$password')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function editAdmin($data)
{
    $koneksi = Koneksi();
    $id = $data["id"];
    $nm_lengkap = htmlspecialchars($data["nm_lengkap"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);

    $query = "UPDATE admin SET nm_lengkap = '$nm_lengkap', username = '$username', password = '$password' WHERE id_admin = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function deleteAdmin($id)
{
    $koneksi = Koneksi();
    $query = "DELETE FROM admin WHERE id_admin = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
?>