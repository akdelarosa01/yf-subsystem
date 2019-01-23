<?php $__env->startSection('title'); ?>
    Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content blue-madison">
        <form class="login-form" action="<?php echo e(url('/login')); ?>" method="post">
            <!--<div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>
                Enter any username and password. </span>
            </div>-->
            <div class="titlehead">
                <img src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/images/PRICON-LOGO.png')); ?>" alt="" class="img-responsive">
            </div>
            <div class="tpicshead text-center">
                <h4>YF YPICS SUBSYSTEM</h4>
            </div>


            <div class="form-group <?php echo e($errors->has('user_id') ? 'has-error' : ''); ?>">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">User ID</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control input-sm placeholder-no-fix" type="text" placeholder="User ID" name="user_id" id="user_id" value="<?php echo e(old('user_id')); ?>"/>
                    <?php if($errors->has('user_id')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('user_id')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control input-sm placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password"/>
                    <?php echo e(csrf_field()); ?>

                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>


            <div class="form-actions">
                <button type="submit" class="btn blue"><i class="fa fa-send"></i> Login </button>
                <button type="button" onclick="javascript:reset()" class="btn blue pull-right"><i class="fa fa-refresh"></i> Reset </button>
            </div>
            
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        function reset() {
            $('#user_id').val("");
            $('#password').val("");
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.loginlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>