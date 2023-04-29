<?php 
  $session = session();
  $userData = $session->get();
  ?>

<h4 class="p-3">Welcome back user, <?= $userData['username'] ?></h4>


<div class="table-responsive">
    <table class="table table-striped table-bordered table-dark" >
        <thead class="thead-dark" >
            <tr >
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Product Name</th>
                <th class="text-center" scope="col">File/Img</th>
                <th class="text-center" scope="col">Description</th>
                <th class="text-center" scope="col">Price</th>
                <th class="text-center" scope="col">Date Created</th>
                <th class="text-center" scope="col">Date U</th>
                <th class="text-center" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody >
        <!-- prod_name','prod_file','prod_desc','prod_price','prod_create','prod_updated -->
            <?php foreach ($products as $product) : ?>
            <tr>
                <td ><?= $product['id'];?></td>
                <td><?= $product['prod_name'];?></td>
                <td><?= $product['prod_file'];?></td>
                <td><?= $product['prod_desc'];?></td>
                <td><?= $product['prod_price'];?></td>
                <td><?= $product['prod_create'];?></td>
                <td><?= $product['prod_updated'];?></td>
                <td class="d-flex justify-content-center">
                    <a><i class="bi bi-pencil-fill p-2" style="font-size:1.5em; color:green" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                    <a onclick="return confirm('Are you sure you want to delete this product?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"style="font-size:1.5em; color:red"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
