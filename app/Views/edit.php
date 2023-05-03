<?php 
$page_session = \Config\Services::session();
$userData = $page_session->get();
?>
<?php if ($page_session->getTempdata('successEdit')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $page_session->getTempdata('successEdit');?>
    </div>
<?php endif; ?>
<form action="<?=base_url('/dashboard/update/')?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="">Name: </label>
        <input type="text" name="editName" value="<?= old('name');?>">
        <span class="text-danger"><small><?= validation_show_error('name'); ?></small></span>
    </div>
    <div>
        <label for="">File: </label>
        <input type="file" name="file">
        <span class="text-danger"><small><?= validation_show_error('name'); ?></small></span>
    </div>
    <div>
        <label for="">Description: </label>
        <textarea name="editDescription" id="" cols="" rows="" value="<?= old('description');?>"></textarea>
        <span class="text-danger"><small><?= validation_show_error('name'); ?></small></span>
    </div>
    <div>
        <label for="">Price: </label>
        <input type="number" name="editPrice" value="<?= old('price');?>">
        <span class="text-danger"><small><?= validation_show_error('name'); ?></small></span>
    </div>

    <button>Edit</button>
    <button type="reset">Reset</button>
    <button>Back</button>
</form>