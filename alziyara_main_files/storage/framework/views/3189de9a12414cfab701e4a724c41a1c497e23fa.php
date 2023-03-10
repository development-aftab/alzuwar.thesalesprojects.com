
    
    
        
        
    

<div class="form-group <?php echo e($errors->has('Title') ? 'has-error' : ''); ?>">
    <label for="Title" class="col-md-4 control-label"><?php echo e('Title'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="Title" type="text" id="Title" value="<?php echo e($roomsfeaturelist->Title??''); ?>" required>
        <?php echo $errors->first('Title', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('ImageIcon') ? 'has-error' : ''); ?>">
    <label for="ImageIcon" class="col-md-4 control-label"><?php echo e('Image Icon'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="ImageIcon" type="text" id="ImageIcon" value="<?php echo e($roomsfeaturelist->ImageIcon??''); ?>" >
        <?php echo $errors->first('ImageIcon', '<p class="help-block">:message</p>'); ?>

    </div>
</div><div class="form-group <?php echo e($errors->has('Description') ? 'has-error' : ''); ?>">
    <label for="Description" class="col-md-4 control-label"><?php echo e('Description'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="Description" type="text" id="Description" value="<?php echo e($roomsfeaturelist->Description??''); ?>" >
        <?php echo $errors->first('Description', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

    
    
        
        
    


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
    </div>
</div>
<?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/roomsFeatureList/rooms-feature-list/form.blade.php ENDPATH**/ ?>