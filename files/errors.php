<?php if(count($errors) > 0) : ?>
    <div class="errors">
        <ul> 
        <?php 
            foreach($errors as $k){
                echo "<li>".$k."</li>";
            }
        ?>
    </ul></div>
<?php endif ?>