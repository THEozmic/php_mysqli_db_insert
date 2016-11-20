<?php
	require "db_connect.php";

	function querydb($query_build) {

    		$query = mysqli_query($GLOBALS['connect'], $query_build);

    		if (!$query) {
			    printf("Error: %s\n", mysqli_error($GLOBALS['connect']));
			    //exit();
			}

    		$n = 0;
    		$result = [];

	    	while ($a = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

	            $result[$n] = $a;

	            $n++;
	        }

	        unset($a);

    		$error_msg = ""; // init custom error message


			if (!$query) { // check if we get an error

				$error_num = mysqli_errno($GLOBALS['connect']); // get error message


				// start checking error numbers and creating custom messages
				if ($error_num == 1062) {
					$error_msg = "An Error has occured";
				}

				return $error_num;

			} else {
				return $result;
			}
	}
?>
