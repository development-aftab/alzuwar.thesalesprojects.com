<div class="form-group <?php echo e($errors->has('city_name') ? 'has-error' : ''); ?>">
    <label for="city_name" class="col-md-4 control-label"><?php echo e('City Name'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="city_name" type="text" id="city_name" value="<?php echo e($guidecity->city_name??''); ?>" required>
        <?php echo $errors->first('city_name', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
    <label for="status" class="col-md-4 control-label"><?php echo e('Status'); ?></label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status" required>
            <option value="1" <?php if(isset($guidecity->status)): ?> <?php if($guidecity->status == "1"): ?> selected <?php endif; ?> <?php endif; ?>>Active</option>
            <option value="0" <?php if(isset($guidecity->status)): ?> <?php if($guidecity->status== "0"): ?> selected <?php endif; ?> <?php endif; ?>>Inactive</option>
        </select>
        <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
    </div>
</div>
<?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/guideCity/guide-city/form.blade.php ENDPATH**/ ?>