<?php


$items = array();

function list_items($list){
    $result = '';
  foreach ($list as $key => $value) {
        $result .= "[" . ($key + 1) . "] $value\n";
  }
  return $result;
}

function get_input($upper = false) {
    $results = trim(fgets(STDIN));
    return $upper ? strtoupper($results) : $results;
}
function sort_menu($items) {
	echo '(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: ';
	$input = get_input(true);


	switch ($input) {
		case 'A':
			 asort($items);
			break;
		case 'Z':
			 arsort($items);
			 break;
		case 'O':
			ksort($items);
			break;
		case 'R':
			krsort($items);
			break;
		}
	return $items;
}

// Create a function that reads the file, and adds each line to the current TODO list. Loading data/list.txt should properly load the list from above. Be sure to fclose() the file when you are done reading it.
function read_file() {
    echo "Enter the filename: ";
    $filename = get_input();
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    return $contents;
    fclose($handle);
}
do {
    // Echo the list produced by the function
    echo '===================' . PHP_EOL . list_items($items) . PHP_EOL . '===================' . PHP_EOL;

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort, (O)pen file, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(true);

    // Check for actionable input


    if ($input == 'N') {
        echo 'Enter item: ';
        $item = get_input();
        fwrite(STDOUT, "Do you want to add to the Beginning or End of the list?\n");
       $N = get_input(true);
        if ($N == 'B') {
            array_unshift($items, $item);
        }
        elseif ($N == 'E') {
            array_push($items, $item);
        }
    } elseif ($input == 'R') {
        echo 'Enter item number to remove: ';
        $key = get_input();
        unset($items[$key - 1]);
        // $items = array_values($items);
    } elseif ($input == 'S') {

		$items = sort_menu($items);

    } elseif ($input == 'F') {
        array_shift($items);
    } elseif ($input == 'L') {
        array_pop($items);
    } elseif ($input == 'O') {
        $content = read_file();
        $content_array = explode("\n", $content);
        $items = array_merge($items, $content_array);
    }


} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);