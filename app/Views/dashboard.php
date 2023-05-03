<?php 
  $session = session();
  $userData = $session->get();
  ?>
<div class="d-flex flex-row align-items-center">
<h5 class="p-3 ">Welcome back, User <?= $userData['username'] ?></h5>
<a class="btn btn-primary text-decoration-none text-light" href="<?=base_url('/Add');?>">Add</a>
<input class="form-control w-25 my-2 ml-2" id="myInput" type="text" placeholder="Search...">
</div>
<div class="table-responsive">
    <table class="table table-bordered"  >
        <thead class="thead-white">
            <tr>
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Product Name</th>
                <th class="text-center" scope="col">File/Img</th>
                <th class="text-center" scope="col">Description</th>
                <th class="text-center" scope="col">Price</th>
                <th class="text-center" scope="col">Date Created</th>
                <th class="text-center" scope="col">Date Updated</th>
                <th class="text-center" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id= "myTable" >
        <!-- prod_name','prod_file','prod_desc','prod_price','prod_create','prod_updated -->
            <?php foreach ($products as $product) : ?>
            <tr>
                <td ><?= $product['id'];?></td>
                <td><?= $product['prod_name'];?></td>
                <td><?= $product['prod_file'];?></td>
                <td><?= $product['prod_desc'];?></td>
                <td>$<?= $product['prod_price'];?></td>
                <td><?= $product['created_at'];?></td>
                <td><?= $product['updated_at'];?></td>
                <td class="d-flex justify-content-center">
                    <a href="<?= base_url('/Dashboard/editPage/')?>"><i class="bi bi-pencil-fill p-2" style="font-size:1.5em; color:green" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                    <a href="<?=base_url('/Dashboard/delete/'.$product['id'])?>" onclick="return confirm('Are you sure you want to delete this product?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash" style="font-size:1.5em; color:red"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
