<?php
session_start();
require_once("../../db/config.php");
if (isset($_GET['category'])) {
$category = $_GET['category'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_categories WHERE id = ?");
$stmt->execute([$category]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
foreach($result as $row){
?>

<div class="form-group">
  <label class="control-label mb-10">Category Name</label>
  <input type="text" value="<?php echo $row[1]; ?>" required name="category" class="form-control txt-cap" >
</div>

<div class="form-group">
  <label class="control-label mb-10">Category Status</label>
  <select name="status" required class="form-control">
	<option value="Active">Active</option>
	<option value="Inactive">Inactive</option>
	</select>
</div>

<input type="hidden" name="cat_id" value="<?php echo $row[0]; ?>">

<div class="form-group mb-0">

  <button name="submit" value="1" type="submit" class="btn btn-success"><span class="btn-text">Save</span></button>
  <a onclick="return confirm('Are you sure?');" class="btn btn-danger" href="admin/core/delete-category?node=<?php echo $row[0]; ?>">Delete</a>
</div>
<?php
}

}else{

}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

}
?>
