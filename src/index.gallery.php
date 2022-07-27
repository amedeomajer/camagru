<?php
			require_once("../config/setup.php");
		
			if (isset($_GET))
			{
				$fetch_image_index = $_GET['load_index'];
				$sql = "SELECT `id` FROM `user_images` ORDER BY `upload_date` DESC LIMIT $fetch_image_index , 4";
				$statement = $pdo->query($sql);
				$images = $statement->fetchAll(PDO::FETCH_ASSOC);
				if (!empty($images)){
					echo'<table>';
					foreach($images as $image)
					{
						echo '
						<tr><td>
						<img src="' . $image['id'] . '">
						</td></tr>';
					}
					echo '</table>';
				}
			}
		?>