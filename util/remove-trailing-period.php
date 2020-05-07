<?php

//This script takes a string, and, if there is a period at the end of it, removes it, then returns the result

echo preg_replace('/\.$/', '', $argv[1]);

?>