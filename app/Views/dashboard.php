<?php 
  $session = session();
  $userData = $session->get();
?>
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Import Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data" action="<?= base_url('/Dashboard/import'); ?>">
        <div class="modal-body">
          <div class="form-group">
            <label for="importFile"><h4>Choose File: </h4></label>
            <input type="file" class="form-control-file" id="importFile" name="importFile">
          </div>
          <div class="form-group-sm">
            <label for="user">User:</label>
            <input class="form-control-plaintext disabled" type="text" name="user" id="user" value="<?php echo $userData['id'];?>" readonly>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="bg-light py-3">
  <div class="container d-flex align-items-center">
    <h5 class="p-3 mb-0 text-uppercase">Welcome back, User <?= $userData['username'] ?></h5>
    <a class="btn btn-primary mr-2 rounded-pill" href="<?= base_url('/Add'); ?>">Add</a>
    <a class="btn btn-primary rounded-pill" href="#importModal" data-toggle="modal">Import</a>
    <form class="form-inline my-2 my-lg-0 ml-auto" action="<?= base_url('/dashboard/search') ?>" method="get">
      <input class="form-control mr-sm-2" type="text" placeholder="Search..." aria-label="Search" id="myInput" name="searchTable">
    </form>
  </div>
</div>


<div class="container mt-4">
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Product Name</th>
          <th class="text-center">File/Img</th>
          <th class="text-center">Description</th>
          <th class="text-center">Price</th>
          <th class="text-center">Created At</th>
          <th class="text-center">Updated At</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody id="myTable">
  <?php if (empty($products)): ?>
  <tr>
    <td colspan="8" class="text-center">No Products/Results found.</td>
  </tr>
  <?php endif; ?>
  <?php foreach ($products as $product) : ?>
  <tr>
    <td><?= $product['id']; ?></td>
    <td><?= $product['prod_name']; ?></td>
    <td class="text-wrap"><a href="<?= base_url('dashboard/download/' . $product['prod_file']) ?>"><?= $product['prod_file'] ?></a></td>
    <td class="text-wrap"><?= $product['prod_desc']; ?></td>
    <td>$<?= $product['prod_price']; ?></td>
    <td><?= $product['created_at']; ?></td>
    <td><?= $product['updated_at']; ?></td>
    <td class="text-center">
      <a href="<?= base_url('/Dashboard/editPage/' . $product['id']) ?>" class="btn btn-sm btn-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pencil-fill"></i></a>
      <a href="<?= base_url('/Dashboard/delete/' . $product['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></a>
    </td>
  </tr>
  <?php endforeach; ?>
</tbody>
    </table>
  </div>
</div>

