
<?php 
$id=$_GET['id'];

?>
<form onsubmit="submitForm(event,<?php echo $id; ?>);">
    <input type="file" name="image" id="image-selecter" accept="image/*">
    <input type="submit" name="submit" value="Upload Image">
</form>
<div id="uploading-text" style="display:none;">Uploading...</div>
<br>
<img src='xyz' id="preview" alt="No image found">
