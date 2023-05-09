<?php 
$page_session = \Config\Services::session();
$userData = $page_session->get();
?>

<?php if ($page_session->getTempdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $page_session->getTempdata('error');?>
    </div>
<?php endif; ?>
<div class="container my-5">
  <div class="row justify-content-center ">
    <div class="col-sm-8 col-md-6 col-lg-4 border border-dark rounded">
      <h1>Edit Product</h1>
      <form action="<?= base_url('/dashboard/update/'.$product['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-group">
          <label for="editName">Name:</label>
          <input type="text" class="form-control" id="editName" name="editName" value="<?= $product['prod_name'] ?>">
          <span class="text-danger"><?= validation_show_error('editName'); ?></span>
        </div>
        <div class="form-group">
          <label for="editFile">File:</label>
          <input type="file" class="form-control-file" id="editFile" name="editFile">
          <span class="text-danger"><?= validation_show_error('editFile'); ?></span>
        </div>
        <div class="form-group">
          <label for="editDescription">Description:</label>
          <textarea name="editDescription" id="" class="form-control" rows="6"><?= $product['prod_desc'] ?></textarea>
          <span class="text-danger"><?= validation_show_error('editDescription'); ?></span>
        </div>
        <div class="form-group">
          <label for="editPrice">Price:</label>
          <input type="decimal" class="form-control" id="editPrice" name="editPrice" value="<?= $product['prod_price'] ?>">
          <span class="text-danger"><?= validation_show_error('editPrice'); ?></span>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Edit</button>
          <a href="<?= base_url('/dashboard') ?>" class="btn btn-danger">Back</a>
        </div>
      </form>
    </div>
  </div>
</div>




