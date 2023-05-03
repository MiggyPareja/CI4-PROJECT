<?php 
  $session = session();
  $userData = $session->get();
  ?>
<div class="d-flex flex-row align-items-center">
    <h5 class="p-3 ">Welcome back, User <?= $userData['username'] ?></h5>
    <a class="btn btn-primary text-decoration-none text-light mr-2" href="<?=base_url('/Add');?>">Add</a>
    <a class="btn btn-primary text-decoration-none text-light" href="<?=base_url('/Add');?>">Import</a>
    <form class="form-inline my-2 my-lg-0 ml-auto" action="<?= base_url('/dashboard/search')  ?>" method="get">
        <input class="form-control mr-sm-2" type="text" placeholder="Search..." aria-label="Search" id="myInput" name="searchTable">
    </form>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
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
        <tbody id="myTable">
            <?php if (empty($products)): ?>
            <tr>
                <td colspan="8" class="text-center">No results found.</td>
            </tr>
            <?php endif; ?>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product['id'];?></td>
                <td class="text-wrap"><?= $product['prod_name'];?></td>
                <td><a href="<?=base_url('dashboard/download/' . $product['prod_file'])  ?>"><?= $product['prod_file']?></a></td>
                <td class="text-wrap"><?= $product['prod_desc'];?></td>
                <td class="text-wrap">$<?= $product['prod_price'];?></td>
                <td class="text-wrap"><?= $product['created_at'];?></td>
                <td class="text-wrap"><?= $product['updated_at'];?></td>
                <td class="text-center">
                    <a href="<?= base_url('/Dashboard/editPage/' . $product['id'])?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                    <a href="<?=base_url('/Dashboard/delete/'.$product['id'])?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>





