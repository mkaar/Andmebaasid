<?php
    if(isset($GET_["error"])){
?>
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Warning!</strong> Better check yourself, you're not looking too good.
    </div>
<?php
    }
    elseif(isset($GET_["add"])){
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Warning!</strong> Better check yourself, you're not looking too good.
    </div>
<?php
}
    if(isset($GET_["remove"])){
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Warning!</strong> Better check yourself, you're not looking too good.
    </div>
<?php
}
?>