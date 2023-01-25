<?php
// $dataが配列だった場合にも対応したXSS対策
function es($data, $charset = 'UTF-8')
{
    if (is_array($data)) {
        return array_map(__METHOD__, $data);
    } else {
        return htmlspecialchars($data, ENT_QUOTES, $charset);
    }
}

//文字エンコードのチェックを行う
function cken(array $data)
{
    $result = true;
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $value = implode("", $value);
        }
        if (!mb_check_encoding($value)) {
            $result = false;
            break;
        }
    }
    return $result;
}


if (!cken($_POST)) {
    $encoding = mb_internal_encoding();
    $err = "Encoding Error! The excepted encoding is " . $encoding;
    exit($err);
}
$_POST = es($_POST);



function checked($value, $question)
{
    if (is_array($question)) {
        $isChecked = in_array($value, $question);
    } else {
        $isChecked = ($value === $question);
    }
    if ($isChecked) {
        echo "checked";
    } else {
        echo "";
    }
}



function selected($value, $question)
{
    if (is_array($question)) {
        $isSelected = in_array($value, $question);
    } else {
        $isSelected = ($value === $question);
    }
    if ($isSelected) {
        echo "selected";
    } else {
        echo "";
    }
}

//配列をシャッフルする関数
function mt_shuffle(array $array)
{
    for ($i = count($array) - 1; $i > 0; --$i) {
        $j = mt_rand(0, $i);
        $tmp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $tmp;
    }
    return $array;
}

//スマホ判定
function is_mobile()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if(strpos($user_agent,'Safari')&&(strpos($user_agent,'Chrome')===false)&&(strpos($user_agent,'Egde')===false)){
        return true;
    }

    return preg_match('/iphone|ipod|ipad|android|Firefox/ui', $user_agent) != 0;
}

function killSC()
{
    $_SESSION = array();
    setcookie('username', "", time() - 1800);
    setcookie('half_flag', "", time() - 1800);
}
