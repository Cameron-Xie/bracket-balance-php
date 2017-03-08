<?php

function balanceBrackets($str)
{
    $brackets = [
        '{' => '}',
        '[' => ']',
        '(' => ')'
    ];

    // get brackets from string, put it into a array.
    preg_match_all('/[(){}\[\]]/', $str, $matches);

    return sortBracketArray($matches[0], $brackets);
}

function sortBracketArray($ary, $brackets)
{
    // return false, if $brackets is not a array.
    if (!is_array($ary)) return false;

    // return false, if array is empty.
    if (count($ary) == 0) return true;

    // return false, if only one element/bracket left.
    if (count($ary) == 1) return false;

    $openBracket = $ary[0];

    // return false, if the first element in the array is a close bracket,
    if (!isset($brackets[$openBracket])) return false;

    // try to find the paired close bracket
    $closeBracketIndex = getCloseBracket($openBracket, $brackets[$openBracket], $ary);

    // return false, if paired close bracket can't be found.
    if($closeBracketIndex == 0) return false;

    // separate the array into two parts.
    $leftBracketArray = array_slice($ary, 1, $closeBracketIndex - 1);
    $rightBracketArray = array_slice($ary, $closeBracketIndex + 1);

    // recursive calling function, then merge result
    if (sortBracketArray($leftBracketArray, $brackets) && sortBracketArray($rightBracketArray, $brackets)) {
        return 'YES';
    } else {
        return 'NO';
    }
}

function getCloseBracket($openBracket, $closeBracket, $ary)
{
    // counting the open bracket while searching for the close bracket. 
    $openBracketCount = 0;
    
    $closeBracketIndex = 0;

    for ($i = 1, $n = count($ary); $i < $n; $i++) {
        // if there isn't other open bracket, then this is the close bracket we are looking for.
        if ($ary[$i] == $closeBracketIndex && $openBracketCount == 0) {
            $closeBracketIndex = $i;
            break;
        }

        if ($ary[$i] == $openBracket) $openBracketCount++;
        if ($ary[$i] == $closeBracket) $openBracketCount--;
    }

    return $closeBracketIndex;
}

// Examples:

//$testStr = '{[}]';
//$testStr = '{}[]{}';
$testStr = '{{[()]}}{}';

$result = balanceBrackets($testStr);
echo $result;
