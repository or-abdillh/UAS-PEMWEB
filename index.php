<!DOCTYPE html>
<html lang="en">
<?php 

    require("./helper/connection.php");
    session_start();

    //If user not login redirect to login pages
    if ( $_SESSION["login"] < 1 ) {
        header('Location: ./pages/login.php?redirect=login');
    } 
    //Menampilkan data dari DB
    $sql = "SELECT products.id_product, products.name_product, products.price_unit, products.price_product, products.category_id, products.create_at, products.last_modified, categorys.category FROM products INNER JOIN categorys ON products.category_id = categorys.id_category";
    $rows = mysqli_query($conn, $sql);

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Index css -->
    <link rel="stylesheet" href="./styles/index.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <title>Stock - Inventory Management System</title>
</head>
<body>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Stock - Inventory Management</h1>
        <p class="col-md-8 fs-4">
            Aplikasi pengelolaan inventaris toko berbasis website untuk mempermudah pemilik usaha dalam mengelola inventaris usahanya dengan mudah.
        </p>
      </div>
    </div>

    
    <div class="px-5 py-3">

        <!-- Table -->
        <h3>Dashboard</h3>

        <div class="card text-white bg-primary mt-3 mb-5 w-full">
            <div class="card-header">
                <i class="fas fa-box"></i>
                Produk
            </div>
            <div class="card-body d-flex">
                <h5 class="card-title me-3">
                    <?php echo mysqli_num_rows($rows); ?>
                </h5>
                <p class="card-text">Jumlah produk yang anda kelola.</p>
            </div>
        </div>
        
        <!-- Table -->
        <h3>List Products</h3>

        <!-- Create new data -->
        <a href="./pages/new.php" class="btn btn-success mt-3 mb-2">
            Tambah product
            <i class="fa fa-plus"></i>
        </a>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Unit Harga</th>
                    <th>Kategori</th>
                    <th>Dibuat pada</th>
                    <th>Terakhir kali diupdate</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                //Fetch data
                if (mysqli_num_rows($rows) > 0) {
                    
                    //Print data
                    $id_table = 1;
                    while($row = mysqli_fetch_assoc($rows)) {
                        // get data
                        $id = $row["id_product"];
                        $price = $row["price_product"];
                        $unit = $row["price_unit"];
                        $product = $row["name_product"];
                        $create_at = $row["create_at"];
                        $last_modified = $row["last_modified"];
                        $category = $row["category"];

                        echo <<<EOT
                        <tr>
                            <td>$id_table</td>
                            <td>$product</td>
                            <td>$price</td>
                            <td>$unit</td>
                            <td>$category</td>
                            <td>$create_at</td>
                            <td>$last_modified</td>
                            <td>
                                <a href="./pages/edit.php?id=$id" class="btn btn-primary w-full mb-2"><i class="far fa-edit"></i></a>
                                <a data-key="$id" data-name="$product" data-role="trigger-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger w-full mb-2"><i class="far fa-trash-alt"></i></a>
                            </td>
                        <tr/>
        EOT;
                        $id_table++;
                    }
                }

                ?>
            </tbody>
        </table>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header bg-danger text-light">
        <h5 class="modal-title" id="exampleModalLabel">Anda yakin ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        Anda akan menghapus data secara permanen
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a data-role="link-modal" href="./helper/delete.php" type="button" class="btn btn-primary">Next</a>
    </div>
    </div>
</div>
</div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>