<?php
/*
40 じゃんけんを作成しよう！
下記の要件を満たす「じゃんけんプログラム」を開発してください。
要件定義
・使用可能な手はグー、チョキ、パー
・勝ち負けは、通常のじゃんけん
・PHPファイルの実行はコマンドラインから。
ご自身が自由に設計して、プログラムを書いてみましょう！
*/
echo "問題40" . PHP_EOL;

const STONE = 0;
const SCISSOR = 1;
const PAPER = 2;
const NAME_COUNT = 10;

const HAND_TYPE = array(
    STONE => 'グー',
    SCISSOR => 'チョキ',
    PAPER => 'パー'
);

function checkName($memo) {
    
    if($memo === "") {
        echo "入力されていません。";
        return false;
    }
    if((mb_strlen($memo)) >= NAME_COUNT) {
        echo "名前は10文字以内です。";
        return false;
    }
    return true;
}
    
function checkNum($memo) {
    
    if($memo === "") {
        echo "入力されていません。";
        return false;
    }
    if(HAND_TYPE[$memo] === null) {
        echo "0~2の数字ではありませんでした。";
        return false;
    }
    return true;
}

function input($type) {

    $memo = trim(fgets(STDIN));
    
    if($type === 'name') {
        
        $check = checkName($memo);
    }
    if($type === 'num') {
    
        $check = checkNum($memo);
    }
    if($check === false) {
        
        return input($type);
    }
    return $memo;
}

function getComHand() {
    srand();
    $comhand = rand(STONE, PAPER);
    return $comhand; 
}

function judge($myhand, $comhand) {

    $calculation = ($myhand - $comhand + 3) % 3;
    return $calculation;
}

function showResult($name, $result) {

    switch ($result) {

        case SCISSOR:
            echo "{$name}さん、残念でした.." . PHP_EOL;
            return;
        case PAPER:
            echo "{$name}さん、おめでとうございます！" . PHP_EOL;
            return;
        }
}

function showMyHand($myhand, $name) {

    echo "{$name}さんは" . HAND_TYPE[$myhand] . "を出しました。" . PHP_EOL;
    return; 
}

function showComHand($comhand, $name) {

    echo "こちらは" . HAND_TYPE[$comhand] . "を出しました。" . PHP_EOL;
    return;
}

function showRule() {

    echo "グーの時は「0」キー、チョキの時は「1」キー、" . PHP_EOL;
    echo "パーの時は「2」キーを押して、ENTERキーを押してください。" . PHP_EOL;
    return;
}

function main($name) {

    $myhand = input('num');
    showMyHand($myhand, $name);

    $comhand = getComHand();
    showComHand($comhand, $name);

    $result = judge($myhand, $comhand);
    if ($result === STONE) {
        echo "あいこでした！" . PHP_EOL;
        showRule();
        echo "せーの、あいこでしょ！" . PHP_EOL;
        main($name);
        return;
    }
    showResult($name, $result);
    
    echo "{$name}さん、もう一度ジャンケンしましょう！" . PHP_EOL;
    echo "yesの時は「1」、noの時は「0」を入力して、ENTERキーを押してください。" . PHP_EOL;
    
    $nextgame = input('num');
    if($nextgame == SCISSOR) {
        showRule();
        main($name);
    }
    return;
}

function game() {

    echo "あなたの名前を教えてください。";
    $name = input('name');
   
    echo "{$name}さん、ジャンケンをしましょう！" . PHP_EOL;
    showRule();
    echo "せーの、ジャンケンポン！" . PHP_EOL;
    main($name);
    
    echo "また遊びましょう＾＾";
    return;
}
game();
?>