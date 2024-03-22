<?php
require_once('config/db.class.php');

class Category
{
    public $cateID;
    public $categoryName;
    public $description;
    
    function __construct($cate_name, $desc)
    {
        $this->categoryName = $cate_name;
        $this->description = $desc;
    }

    // Get the product category category list
    public static function list_category()
    {
        $db = new Db();
        $sql = "SELECT CateID, CategoryName FROM category";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
?>
<div class="lblinput">
    <select name="txtcateid">
        <option value="" selected>-- Select type --</option>
        <?php $cates = Category::list_category(); ?>
        <?php foreach ($cates as $item) { ?>
            <option value="<?php echo $item['CateID']; ?>"><?php echo $item['CategoryName']; ?></option>
        <?php } ?>
    </select>
</div>
