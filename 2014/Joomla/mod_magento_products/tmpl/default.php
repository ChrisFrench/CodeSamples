<style >
#mod_magento_products  { border: #999 solid 2px; display: block; float: none; width: 100%;}
.mod_magento_products_item { float: left; margin: 10px; width: 200px; list-style: none; text-align: center;}
.magentoName { text-decoration: none;}
.magentoPriceWrapper {background-color: #999; padding: 10px; }
.magentoTopWrapper {height: 300px; display: block; margin: 0 auto; width: 200px; }
.productImage { margin-left: 25px; }
.magentoPrice { color: #fff; font-size: 1.5em; margin-bottom: 5px;}
</style>


<div id="mod_magento_products">



<?php foreach ($items as $product) : ?>

<div class="mod_magento_products_item">
	<div class="magentoTopWrapper">
	<a href="http://test.musculardevelopmentstore.com/index.php/catalog/product/view/id/<?php echo $product->entity_id; ?>">
	<img  class="productImage" height="150px" src="<?php echo $product->staff_customimageurl; ?>" > <br>
	<div class="magentoName"><?php echo $product->name; ?></div>
	</a>

	<div class="magentoDesc"> <?php echo substr($product->description, 0, 150); ?>...</div>
	</div>
	<div class="magentoPriceWrapper">
	<div class="magentoPrice"> $<?php echo $product->regular_price_without_tax; ?> </div>
	<a class="magentoButton btn button" role="button" href="http://test.musculardevelopmentstore.com/index.php/catalog/product/view/id/<?php echo $product->entity_id; ?>">View Product</a>
	</div>
</div>


<?php endforeach; ?>
<br clear="both">

</div>