<?php
class design1{
    protected $_db = null;
    public function getCountItem()
    {
        if (!$_COOKIE["itemsBasket"])
            return 0;
        $value = substr_count($_COOKIE["itemsBasket"], ",") + 1;
        $last2Digits = $value % 100;
        $lastDigit = $value % 10;
        if ($last2Digits > 10 and $last2Digits < 20)
            return $value . " товаров";
        else
        {
            if ($lastDigit == 0 or $lastDigit == 5 or $lastDigit == 6 or $lastDigit == 7 or
                $lastDigit == 8 or $lastDigit == 9)
                return $value . " товаров";
            else
                if ($lastDigit == 1)
                    return $value . " товар";
                else
                    return $value . " товара";
        }
    }
    //Выводит глалный рубрикатор
    public function printMainRubricator()
    {
        print "<ul id='mainRubrikator'>";
		$sql = "SELECT name, alias, doc_id FROM wm_Documents WHERE parent_id = 1169 AND published = 1 AND alias <> '' ORDER BY doc_id";
		if(!$this->_db)
		    $this->_db = pdoConn::getInstance();
		$res = $this->_db->query($sql);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) { 
     		print "<li><a href='".$row["alias"]."'>".$row["name"]."</a></li> ";
		}
		print "</ul>";
    }
    //Возвращает свойства документа по id
    public function getFieldValue($id){
		$sql = "SELECT value FROM wm_Properties WHERE field_id = ".$id;
		if(!$this->_db)
		    $this->_db = pdoConn::getInstance();
		$res = $this->_db->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
        return $row["value"];
    }
    public function catEnumChildGroups($parent_id){
	if (!$parent_id or $parent_id == -1){
	    $sql = "SELECT * FROM catalog_groups WHERE parent_id IS NULL";
	}
	else{
	    $sql = "SELECT * FROM catalog_groups WHERE parent_id = '$parent_id'";
	}
	$sql .= " AND published = 1 ORDER BY ISNULL(group_order, 999999) ASC";
	if(!$this->_db)
	    $this->_db = pdoConn::getInstance();
        var_dump($this->_db);
	$res = $this->_db->query($sql);
	$i = 0;
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
	    $groups[$i]["id"] = $row["id"];
	    $groups[$i]["parent_id"] = $row["parent_id"];
	    $groups[$i]["name"] = $row["name"];
	    $groups[$i]["description"] = $row["description"];
	    $groups[$i]["comment"] = $row["comment"];
	    $groups[$i]["published"] = $row["published"];
	    $groups[$i]["color"] = $row["color"];
	    $groups[$i]["alt_name"] = $row["alt_name"];
	    $groups[$i]["alt_title"] = $row["alt_title"];
	    $groups[$i]["meta_keywords"] = $row["meta_keywords"];
	    $groups[$i]["meta_description"] = $row["meta_description"];
	    $i++;
	}
	return $groups;
    }
    function printCatNode($id, $color){
	$group_path = null;
	$child_groups = $this->catEnumChildGroups($id);
	if (count($child_groups) == 0)
	    return;
	print '<ul class="listChildGroup">';
	for ($j = 0; $j < count($child_groups); $j++ ){
	    if(trim($child_groups[$j]["alt_name"]))
		$name = $child_groups[$j]["alt_name"];
	    else
		$name = $child_groups[$j]["name"];
	  
	    $link = "/ishop/catalog?group=".$child_groups[$j]["id"];
	    print '<li style="border-left: 1px solid #'.$color.'">';
	    print '<a href="' .$link. '">' . $name . '</a>';
	    $this->printCatNode($child_groups[$j]["id"]);
	    print '</li>';  
	}
	print "</ul>";
    }
    function printCatalogRubricator(){
	?>
	<div id="leftRubrikator">
	    <div id="allCatalog"><a href="#">ВЕСЬ КАТАЛОГ</a></div>
	<ul id="listMainRubr">
	<?php
	$goodsGroups = $this->catEnumChildGroups(0, 1);
	for ($i = 0, $j = 0; $i < count($goodsGroups); ++$i ){
	    if ( !$goodsGroups[$i]["published"])
            continue;
	    $id = $goodsGroups[$i]["id"];
	    $name = $goodsGroups[$i]["name"];
	    $color = $goodsGroups[$i]["color"];
	    $link = "/ishop/catalog?group=$id";
	    ?>
	    <li class='headGroup' id="<?=$id?>">
		<div style="background-color:#<?=$color?>" class='colorHeadGroup'></div>
		<a href="<?=$link ?>"  onclick="return showGroup(<?=$id ?>);" ><span><?=$name?></span></a>
	    <?php    
	    $this->printCatNode($goodsGroups[$i]["id"], $color);
	    print "</li>";
	    ?>
<?php }
    print "</ul>";
    print "</div>";
    }
}
?>
