<?php 
$page_session = \Config\Services::session();
$userData = $page_session->get();
?>
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-4 border border-dark rounded p-4">
        <h1>Create Product</h1>
            <?php if ($page_session->getTempdata('successStore')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $page_session->getTempdata('successStore');?>
                </div>
            <?php endif; ?>
<form class="" action="<?= base_url('/Add/store')?>" method="post" enctype="multipart/form-data">
        <div class="form-group-sm ">
            <label for="name">Name:</label>
            <input class="form-control input-sm" type="text" name="name" id="name" >
            
            <span class="text-danger"><small><?= validation_show_error('name'); ?></small></span>
        </div>
        <div class="form-group-sm">
            <label for="file">File:</label>
            <input class="form-control-file" type="File" name="file" id="file">
        </div>
        <div class="form-group-sm">
            <label  for="desciption">Description:</label>
            <textarea class="form-control" class="align-middle" name="description" id="description" style="resize:none;"></textarea>
            <span class="text-danger"><small><?= validation_show_error('description'); ?></small></span>
        </div>
        
        <div class="form-group-sm mb-3">
            <label for="price">Price:</label>
            <input class="form-control" type="number" name="price" id="price">
            <span class="text-danger"><small><?= validation_show_error('price'); ?></small></span>
        </div>
        <div class="form-group-sm" hidden>
            <label for="user">User:</label>
            <input class="form-control-plaintext disabled" type="text" name="user" id="user" value="<?php echo $userData['id'];?>" readonly>
        </div>
        <div class="form-row">
            <a ><input class="form-control col-auto bg-primary text-white " type="submit" value="Create Product"></a>
            <a ><input class="form-control col-auto bg-secondary text-white"  type="reset"></a>
            <a href="<?=base_url('/Dashboard')?>"><input type="button" class=" btn btn-danger form-control col-auto" value="Back"></a>
        </div>
</form>
        </div>
    </div>
</div> 



        