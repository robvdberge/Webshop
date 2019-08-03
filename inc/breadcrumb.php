<?php

if ( isset($id) ){
    $getCatName = $cat->getCatById($id);
    if ($getCatName){
        while ($result = $getCatName->fetch_assoc()){
            $bcArray[$result["catName"]] = 'productbycat.php?catId='.$id.'';	
        }
    }
}
if ( isset($pId) ){
    $getBcCat = $pd->getCidByPid($pId);
    if ($getBcCat){
        while ($result = $getBcCat->fetch_assoc()){
            $bcArray[$result["catName"]] = 'productbycat.php?catId='.$result['catId'].'';
        }
    }
    
}
?>

<div class="breadcrumb-container">
    <ul class="breadcrumb">
        <li><a href="index.php" class="home"></a></li>
        <!-- <li><a href="#">Categorie</a></li>
        <li><a href="#">Product</a></li> -->
        <?php 
        if (isset($bcArray)){
            foreach ($bcArray as $k => $v){
                echo '<li><a href="'.$v.'">'.$k.'</a></li>';
            }
        }
        ?>
    </ul>
</div>

