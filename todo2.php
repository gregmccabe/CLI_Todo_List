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
function read_file($filename) {
    $handle = fopen($filename, "r");
    $contents = trim(fread($handle, filesize($filename)));
    fclose($handle);
    return $contents;
}
// If the file they are saving to exists, warn the user and ask for them to confirm overwriting the file. If the user chooses not to proceed, cancel the save and return to the main menu with TODOs listed.

//    if (file_exists) {
//     issue warning message
//        ask for continue Y/N?
            // if Yes, then save over file
            //     else exit
// }  else


function write_file_save($filename, $items) {
    if (file_exists($filename)) {
        echo "File exists, do you want to overwrite Y/N:";
        $overwrite = get_input(TRUE);
        if ($overwrite == 'Y') {
            $handle = fopen($filename, 'w');
            foreach ($items as $item) {
                fwrite($handle, $item . PHP_EOL);
            }
            fclose($handle);
            echo "Save successful!\n";
        } else {
            echo "File not saved.\n";
        }
    }
}

do {
    // Echo the list produced by the function
    echo '===================' . PHP_EOL . list_items($items) . PHP_EOL . '===================' . PHP_EOL;

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort, (O)pen file, s(A)ve, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines

    // Check for actionable input
    $input = get_input(true);

// When s(A)ve is chosen, the user should be able to enter the path to a file to have it save. Use fwrite() with the mode that starts at the beginning of a file and removes all the file contents, or creates a new one if it does not exist. After save, alert the user the save was successful and redisplay the list and main menu.



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
        echo "Enter the filename: ";
        $filename = get_input();

        $content = read_file($filename);
        $content_array = explode("\n", $content);
        $items = array_merge($items, $content_array);
    } elseif ($input == 'A') {
        echo "Enter the filename: ";

        $filename = get_input();
        write_file_save($filename, $items);
        // $handle = fopen($filename, 'w');

        // foreach ($items as $item) {
        //     fwrite($handle, $item . PHP_EOL);
        // }
        // fclose($handle);
    }



} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);