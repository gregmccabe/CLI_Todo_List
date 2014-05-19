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
			 sort($items);
			break;
		case 'Z':
			 rsort($items);
			 break;
		case 'O':
			asort($items);
			break;
		case 'R':
			arsort($items);	
			break;
		}
	return $items;
}

do {
    
    // Echo the list produced by the function
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(true);

    // Check for actionable input
    if ($input == 'N') {
        echo 'Enter item: ';
        $items[] = get_input();
       
    } elseif ($input == 'R') {
        echo 'Enter item number to remove: ';
        $key = get_input();
        unset($items[$key - 1]);
        $items = array_values($items);
    } elseif ($input == 'S') {
    	
		$items = sort_menu($items);
		
    }
        		

} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);