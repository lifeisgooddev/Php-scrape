<!DOCTYPE html>
<html>
<head>
	<title></title>
	<head>
		<?php
		ini_set('memory_limit', '512M');
			require('simplehtmldom/simple_html_dom.php');
			$limit = 5;
			set_time_limit(50000);
		?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
</head>
<body>
	<div class="row" style="border-bottom: 4px solid; margin: 10px 15px 20px 15px;">
		<!-- MIT Top $ Left -->
		<div class="col-md-12" style="height: 800px ; overflow: auto;">
			<?php
				include('dbcon.php');	
	
				$db = new dbcon();
				$mit_1_news = [];
				//$mit_1_html = file_get_html('https://www.boattrader.com/dealers/print/east-coast-flightcraft-inc.-middleton/2850938/all/');

				$mit_1_html = file_get_html('https://www.boattrader.com/dealers/print/east-coast-flightcraft%2c-inc-meredith/2978286/all/');
				$mit_1_article = $mit_1_html->find('.printable-gallery.ad-table');
				
				$num=1;
				 //$temp=$mit_1_article[0];
				 foreach($mit_1_article as $temp){
					// if(isset($temp->find('.boat-name',0)->innertext)){
					// 	$tmp_title = $temp->find('.boat-name',0)->innertext;
					// }else{
					// 	$tmp_title = 'Empty Title';
					// }
					// $tmp_description = $temp->find('p',0)->innertext;
					// $tmp_link = $temp->find('a',0)->href;
					// $tmp_img = $temp->find('img',0)->src;
					// $mit_1_news[] = [
					// 	'title' => $tmp_title,
					// 	'description' => $tmp_description,
					// 	'date' => 'Not Defined',
					// 	'link' => $tmp_link,
					// 	'img' => $tmp_img
					// ];

				 	/////////////////////////////////////Start Boat list page///////////////////////////////////////
				 	//var_dump($temp);
					$tmp_title = $temp->find('.ad-title a',0)->innertext;
					$tmp_price = $temp->find('.ad-price',0)->innertext;
					$tmp_post_id = $temp->find('.ad-id',0)->innertext;
					$tmp_title1=$tmp_title;
					$tmp_post_id=substr($tmp_post_id, 11,9);
					$tmp_url=$tmp_title;
					$tmp_url=str_replace(" ", "-", $tmp_url);
					$tmp_url=$tmp_url."-".$tmp_post_id;
					
					echo $num;
					echo "<br>";
					echo $tmp_title ;
					echo "<br>";
					echo $tmp_price ;
					echo "<br>";
					echo $tmp_post_id ;
					echo "<br>";
					
					echo $tmp_url ;
					echo "<br>";
					
					
					/////////////////////////////////////End Boat list page///////////////////////////////////////

					$detail_page = file_get_html('https://www.boattrader.com/listing/'.$tmp_url);

					////////////////////////////////////////////////// Save picture
					// $detail_info = $detail_page->find('#carousel1 li');
					// $count=1;
					// foreach($detail_info as $temp1){
						
						
					// 	$tmp_img = 'https:'.$temp1->getAttribute('data-src_w111');
					// 	var_dump($tmp_img);
					// 	//$tmp_img = 'https://images2.boattrader.com/resize/1/85/84/7218584_20190914070930115_1_LARGE.jpg?w=640&h=480&t=1307064';
					// 	$img = 'my/'.$tmp_title.'_'.$count.'.jpg';
					// 	// Remote image URL
						
					// 	$myfile = fopen($img, "w") or die("Unable to open file!");

					// 	//Save image
					// 	$ch = curl_init($tmp_img);
					// 	$fp = fopen($img, 'wb');
					// 	curl_setopt($ch, CURLOPT_FILE, $fp);
					// 	curl_setopt($ch, CURLOPT_HEADER, 0);
					// 	curl_exec($ch);
					// 	curl_close($ch);
					// 	fclose($fp);
					// 	file_put_contents($img, file_get_contents($tmp_img));
					// 	fclose($myfile);
					// 	$count++;
					// }
					/////////////////////////////////////////////////////end save picture


					///////////////////////////////Add Boat Detail////////////////////////////////////////////////////////////////
					/*$tmp_class=$detail_info[0]->innertext;
					$tmp_category=$detail_info[1]->innertext;
					$tmp_year=$detail_info[2]->innertext;
					$tmp_make=$detail_info[3]->innertext;
					$tmp_length=$detail_info[4]->innertext;
					$tmp_propulsion=$detail_info[5]->innertext;
					$tmp_hull=$detail_info[6]->innertext;
					$tmp_fuel=$detail_info[7]->innertext;
					$tmp_location=$detail_info[8]->innertext;

					$description = $detail_page->find('#main-details');
					$tmp_description=$description[0]->innertext;

					echo $tmp_class;
					echo "<br>";
					echo $tmp_category;
					echo "<br>";
					echo $tmp_year;
					echo "<br>";
					echo $tmp_make;
					echo "<br>";
					echo $tmp_length;
					echo "<br>";
					echo $tmp_propulsion;
					echo "<br>";
					echo $tmp_hull;
					echo "<br>";
					echo $tmp_fuel;
					echo "<br>";
					echo $tmp_location;
					echo "<br>";*/
					// $description = $detail_page->find('#main-details');
					// $tmp_description=$description[0]->innertext;
					
					// $db->add_boat_info($tmp_title, $tmp_price,$tmp_post_id,$tmp_class,$tmp_category,$tmp_year,$tmp_make,$tmp_length,$tmp_propulsion,$tmp_hull,$tmp_fuel,$tmp_location,$tmp_description);
					// echo "<br>";
					
					/////////////////////////////////////end boat detail///////////////////////////////////////////////////////////


					////////////////////////////////////start detail page/////////////////////////////////////////////////////////
					
					$detail_info = $detail_page->find('.collapse-content');
					
					foreach($detail_info as $temp1){
						$tmp_feild=$temp1->find('a',0)->innertext;
						$tmp_feild=str_replace('<div class="icon"></div>', "", $tmp_feild);
						$tmp_feild=str_replace('1', "", $tmp_feild);
						$tmp_feild=str_replace(' ', "", $tmp_feild);
						$tmp_value=$temp1->find('.collapsible table',0)->innertext;
						echo $tmp_feild;
						echo "<br>";
						//print_r($tmp_value);
						//echo "<br>";
						echo $tmp_title1;
						$db->update_attribute($tmp_feild, $tmp_value, $tmp_title1, $tmp_price,$tmp_post_id);
					}

					////////////////////////////////////end detail page////////////////////////////////////////////////////////////
					$num++;

				}

					
				 
				
			?>

			
		</div>
		<!-- MIT Right -->
		
	</div>
	
</body>
</html>