function SameGroup_products(){
	
	
	//create the options
	$limit = "12";
	$cols = "4";
	
	global $post, $wpdb;
	
	//get the meta
	$meta_key =  'xline_group_id';
	$postid = $post->ID;// getting the id of viewing pruduct
	
	$compatible_code = get_post_meta( $postid, $meta_key, true );
	
	
	//is it empty?
	if(!$compatible_code){ return; }
	else {
	//$product_ids=0;
	//Get all the product IDS that have the same product meta value (except current product id)
	
	$tmpqry ="SELECT wp_posts.id FROM `wp_posts`INNER JOIN wp_postmeta groupid on wp_posts.ID = groupid.post_id where meta_value ='$compatible_code' and meta_key = '$meta_key' and wp_posts.id !='$postid'";
	
$product_ids = $wpdb->get_col( $tmpqry);

	$sizeofitems= sizeof($product_ids);
		//$tdwidth="width:100%";
		 
 
		
	if (wp_is_mobile())
	{$cols=2; 
	 $tdwidth="max-width='50%' flex='50%'";  
	
	$mystyle=" width: 100px; height: 100px" ;}
		
	elseif ($sizeofitems<5)
	{$cols=2;
	 $tdwidth="max-width='50%' flex='50%'";  
	$mystyle=" width: 200px; height: 200px" ;
				
	}
	elseif ($sizeofitems<10)
	{$cols=3;
	 $tdwidth="max-width='33%' flex='33%'"; 
	  $mystyle=" width: 170px; height: 170px" ;
}
	 
	 elseif ($sizeofitems<17)
	{$cols=4;
	 $tdwidth="max-width='25%' flex='25%'";  
	  $mystyle=" width: 120px; height: 120px" ;
}	
	else
	{$cols=5;
	 $tdwidth="max-width='20%' flex='20%'";
	  $mystyle=" width: 100px; height: 100px" ;
}	
		
		
 $lines = array();
	$products_chunk_array=array_chunk($product_ids, $cols);

	
 


 
 
		if(!$products_chunk_array){ return; }
		else {
	echo '<section class="symvata-montela">
	<label> <strong>Παραλλαγες:</strong></label>
	<br>
	<table class="symvata-table" width="50%" border="0">
		<tbody>';
		
		
		
		
		
		 foreach($products_chunk_array as $ggids ) { 
	 
	echo '<tr>';
	
	 for ($i = 0; $i < $cols; $i++) {
	
		 	
	
							 
				if(!empty($ggids[$i])){
					
				 $product_object = wc_get_product( $ggids[$i]);
					if (  $product_object->is_in_stock() &&  $product_object->is_purchasable() )
					{
					  $buybttn='<a href="' . esc_url( $product_object->add_to_cart_url() ) . '" class="clsActionButton" id="idAddButton" ><i class="fas fa-shopping-basket"></i></a>';
					}
					else {
					$buybttn=' ';
					}
					// echo $i ;
					//$imgurl=get_the_post_thumbnail_url( $ggids[$i]);
					if(empty(get_the_post_thumbnail_url( $ggids[$i])))
					{
						$imgurl='/wp-content/uploads/2021/05/blankicon.jpg';
				//	  
					  }
					  else
					  {$imgurl=get_the_post_thumbnail_url( $ggids[$i]);
					  }
//	echo '<td  '.$tdwidth.'><a href="'.get_permalink( $ggids[$i]).'"><img src="'.get_the_post_thumbnail_url( $ggids[$i]).'" style="'.$mystyle.'"> </a> '.$buybttn.' </td>';}
	echo '<td  '.$tdwidth.'><a href="'.get_permalink( $ggids[$i]).'"><img src="'.$imgurl.'" style="'.$mystyle.'"> </a> '.$buybttn.' </td>';}				
		 else {
			 echo ' <td '.$tdwidth.' > <a href="'.get_permalink( $ggids[$i]).'"><img src="/wp-content/uploads/2021/05/blankicon.jpg" style="'.$mystyle.'"> </a>  </td>';
			  
			//https://clone.epyxida.gr/wp-content/uploads/2021/05/blankicon.jpg
			}
		 
	}
	echo '</tr>';
			}
		 
	echo '</table></section>';}}}
	
