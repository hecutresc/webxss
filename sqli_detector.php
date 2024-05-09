<?php
// Function to search a string in files of the current directory and subdirectories
function buscarStringRecursivo($directory, $stringABuscar, $cadenaNoDeseada) {
    //Gets a list of all the files from the current directory
    $files = scandir($directory);
    // Name of the current script to avoid search in it
    $scriptName = basename(__FILE__); 
    // Counter to enumerate the matches
    $matchesCounter = 0; 
    //Variable to put the output of the scan
    $output = '';

    foreach ($files as $file) {
        $filePath = $directory . '/' . $file;

        // Excludes the archives . and .. of the current directory and this script
        if ($file !== '.' && $file !== '..' && $file !== $scriptName) {
            // If it's a directory does a recursive search in it
            if (is_dir($filePath)) {
                $output .= "Exploring the directory: ".$filePath." <br>";
                $output .= "<hr>";
                buscarStringRecursivo($filePath, $stringABuscar, $cadenaNoDeseada);
            } elseif (is_file($filePath) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                // If is a php file does the search for the string
                // Gets the content of the file
                $content = file_get_contents($filePath);

                //Searches the string with a regular expression
                $pattern = '/^.*(?<!' . preg_quote($cadenaNoDeseada) . ')' . preg_quote($stringABuscar) . '.*$/m';
                if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
                    //Shows the name of the file
                    $output .= "File: $filePath <br>";

                    // Shows the lines where the string matched
                    foreach ($matches as $match) {
                        $linea = $match[0];
                        $numLinea = getLineNumber($content, $linea);
                        $output .= "Line $numLinea: $linea <br>";
                    }

                    // Increases the counter of matches
                    $matchesCounter += count($matches);

                     $output .="<br>";
                }
            }
        }
    }

    $output .= "Total Number of Matches: $matchesCounter";
    return $output;
}

//Function to obtain the number of the line from the content of the file and the line which matches
function getLineNumber($content, $searchedLine) {
    $lines = explode("\n", $content);
    foreach ($lines as $numLine => $line) {
        if ($line === $searchedLine) {
            return $numLine + 1;
        }
    }
    return -1;
}

// Handling the POST parameters from the webview

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['stringToSearch']) && isset($_POST['unwantedString'])){
        $stringToSearch = $_POST['stringToSearch'];
        $unwantedString = $_POST['unwantedString'];

        // Call to the function to search the string and to ensure is not preceded with the unwanted string
        $results = buscarStringRecursivo('./', $stringToSearch, $unwantedString);

        // Enviar la salida HTML al cliente
        echo $results;
    }
}

?>