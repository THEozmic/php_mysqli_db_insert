<?php
	// data is an array: array("column_name" => "column_data");
	// table is name of table;
	//usage: $result = insertdb($_POST, "users");
	//       echo $result;
	// or insertdb(array("column_name" => "column_data"), "table");
		require "db_connect.php";
	function insertdb($data, $table) {
		$colums = "";
		$colums_values = "";

		$length = count($data); // length of array of data lol
		$i = 0; // counter

 		// we need to prevent last comma from appending to the column and the value so  we don't get "michael",


		foreach ($data as $key => $value) {
			$colums .= $key;
			$colums_values .= '"'.$value.'"';

			if(++$i !== $length) {
				//last item
				$colums .= ","; //add comma
				$colums_values .= ",";

			}

		}

		$sql = "INSERT INTO $table ($colums) VALUES ($colums_values)";

		$query = mysqli_query($GLOBALS['connect'], $sql);

		$error_msg = ""; // init custom error message


		if (!$query) { // check if we get an error
			    printf("Error: %s\n", mysqli_error($GLOBALS['connect']));
			    //exit();
			$error_num = mysqli_errno($GLOBALS['connect']); // get error message


			// start checking error numbers and creating custom messages
			if ($error_num == 1062) {
				$error_msg = "Email already taken";
			}

			//implement other error messages

			return $error_msg;

		} else {
			return $query;
		}

	}
?>
