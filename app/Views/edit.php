<?php 
$page_session = \Config\Services::session();
$userData = $page_session->get();
?>

<?php if ($page_session->getTempdata('errorEdit')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $page_session->getTempdata('errorEdit');?>
    </div>
<?php endif; ?>
<form action="<?= base_url('/dashboard/update/'.$product['id']) ?>" method="post" enctype="multipart/form-data">

<?= csrf_field() ?>
    <div>
        <label for="">Name: </label>
        <input type="text" name="editName" value="<?= old('editName');?>">
        <span class="text-danger"><small><?= validation_show_error('editName'); ?></small></span>
    </div>
    <div>
        <label for="">File: </label>
        <input type="file" name="editFile">
    </div>
    <div>
        <label for="">Description: </label>
        <textarea name="editDescription" value="<?= old('editDescription');?>"></textarea>
        <span class="text-danger"><small><?= validation_show_error('editDescription'); ?></small></span>
    </div>
    <div>
        <label for="">Price: </label>
        <input type="number" name="editPrice" value="<?= old('editPrice');?>">
        <span class="text-danger"><small><?= validation_show_error('editPrice'); ?></small></span>
    </div>

    <button type="submit">Edit</button>
    <button type="reset">Reset</button>
    <button> <a href="<?= base_url('/dashboard') ?>">Back</a></button>
</form>