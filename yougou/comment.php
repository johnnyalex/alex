<?php
include 'init.php';
//var_dump($_GET);
//var_dump($_SESSION);
$id=$_GET['id'];
?>
<form action="docomment.php" method="post">
    <textarea cols="100" rows="10" name="comment"></textarea>
    <input type="hidden" name="id" value="<?php echo $id?>">
    <p><input type="submit" value="upload"></p>
</form>
