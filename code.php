<?php

/**
 * Function To get bab or aba string with String as first argument and bool as a flag for converting bab to aba
 * @param type $value String . Single string value to perform search on.
 * @param type $bool Bool. Takes true for converting bab to aba
 * @return type $resultarry Array. Return all aba found as an Array
 */

function getSubArray($value, $bool)
{
    $resultarray = [];
    //Convert string to array to perfrom check for bab and aba
    $arr = str_split($value, 1);
    for ($i = 1; $i < count($arr); $i++) {
        if ($arr[$i - 1] == $arr[$i + 1]) {
            if ($bool) {
                //Converting String from bab to aba for easy matching if bool is true
                $string = $arr[$i] . $arr[$i - 1] . $arr[$i];
            } else {
                $string = $arr[$i - 1] . $arr[$i] . $arr[$i + 1];
            }
            //push string fetched to result array
            array_push($resultarray, $string);
        }
    }
    //Return the aba strings array
    return $resultarray;
}

/**

 * Main function to validate String and return True or false based on condition
 * @param type $arr Array. Main Array consiting of inner and outer [] arrays
 * @return type Bool. ture and flase based on condition matching.
 */
//
function validateString($arr)
{
    $inner_array = [];
    $outer_array = [];
    //Split the array on the Basis of [ and ] .
    $results = preg_split("/[\[\]]/", $arr);
    //
    for ($i = 0; $i < count($results); $i++) {
        //If element at 1 3 5 7... send to inner else to outer array
        if ($i % 2 != 0) {
            //Merge all resulting bab converted to aba to Inner array
            $inner_array = array_merge($inner_array, getSubArray($results[$i], true));
        } else {
            //Merge all resulting aba to Outer array
            $outer_array = array_merge($outer_array, getSubArray($results[$i], false));
        }
    }
    //Match both arrays for common string if any results are found return true else false
    $matching = array_intersect($outer_array, $inner_array);
    if (count($matching) > 0) {
        return true;
    } else {
        return false;
    }
}

//Input file stotred to variable $a
$a = file('sample_input.txt');
// initialized zero to validated_count
$validated_count = 0;
foreach ($a as $value) {
    //function called to check each string in the file and increase the counter if it satisfies the condition.
    if (validateString($value)) {
        $validated_count++;
    }
}
echo 'Total Validated Records :' . $validated_count;

//EOF
