<?php if(count($errors) > 0): ?>
    <?php foreach($errors->all() as $error): ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 error">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Failed!</strong> <?php echo e($error); ?> <br/>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(Session::has('message')): ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> 
                   <i class="fa fa-check-circle"></i> Success!
                </strong> 
                <?php echo e(Session::get('message')); ?>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(Session::has('err_message')): ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="noti">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>
                    <i class="fa fa-exclamation-circle"></i> Failed!
                </strong>  
                <?php echo e(Session::get('err_message')); ?>

            </div>
        </div>
    </div>
<?php endif; ?>