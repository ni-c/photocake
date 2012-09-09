<div id="login-container" class="users form login">
<h4>Login</h4>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('submit')); ?>
</div>