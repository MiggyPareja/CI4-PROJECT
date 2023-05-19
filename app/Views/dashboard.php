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
            <small><i>Max # of data : 2000</i></small>
          </div>
          <div class="form-group-sm" hidden>
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


<div class="bg-white py-2 mt-1 border-bottom">
  <div class="container d-flex align-items-center">
    <h5 class="p-3 mb-0 text-uppercase">Welcome back, User <?= $userData['username'] ?></h5>
    <a class="btn btn-success mr-2 " href="<?= base_url('/Add'); ?>"><i class="bi bi-plus-lg"></i> Add Products</a>
    <a class="btn btn-primary " href="#importModal" data-toggle="modal"><i class="bi bi-download"></i> Import</a>
    <a class="btn btn-danger ml-2 " href="<?= base_url('/dashboard/clear'); ?>"><i class="bi bi-trash"></i> Clear</a>
    
  </div>
</div>



<div class="container p-3 ">
  <div class="d-flex justify-content-between">
    <form class="form-inline my-2 my-lg-0 ml-auto" action="<?= base_url('/dashboard/search') ?>" method="get">
      <input class="form-control mr-sm-2" type="text" placeholder="Search..." aria-label="Search" id="myInput" name="searchTable">
    </form>
    
  </div>
  <?php if ($session->getFlashdata('search')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?= $session->getFlashdata('search');?>
    </div>
<?php endif; ?>
<?php if ($session->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $session->getFlashdata('success');?>
    </div>
<?php endif; ?>
<?php if ($session->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $session->getFlashdata('error');?>
    </div>
<?php endif; ?>
  <div class="table-responsive mt-3 overflow-auto" style="height: 450px; ">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Product Name</th>
          <th>File/Img</th>
          <th>Description</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php if (empty($products)): ?>
          <tr>
            <td colspan="6" class="text-center"><samp>No Products/Results found.</samp></td>
          </tr>
        <?php endif; ?>
        <?php foreach ($products as $product) : ?>
          <tr>
            <td><?= $product['id']; ?></td>
            <td style="max-width: 200px;"><?= $product['prod_name']; ?></td>
            <td class="text-break"><a href="<?= base_url('dashboard/download/' . $product['prod_file']) ?>"><?= $product['prod_file'] ?></a></td>
            <td class="text-break"><?= $product['prod_desc']; ?></td>
            <td>₱<?= $product['prod_price']; ?></td>
            <td>
              <div class="btn-group" role="group">
                <a href="<?= base_url('/Dashboard/editPage/' . $product['id']) ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                <a href="<?= base_url('/Dashboard/delete/' . $product['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></a>
              </div>
            </td>
          </tr>
          <tr class="table-spacing"></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?= $pager->links() ?>
  </div>
</div>




