<?php

function construct()
{
    load_model('index');
}

function getURLAction()
{
    load('helper','string');
    $q = trim($_GET['q']);
    echo "search/?q=" . preg_replace('([\s]+)', '+', escape_string($q));
}

function indexAction()
{
    load('helper','format');
    $q = escape_string($_GET['q']);
    if(strlen($q) > 0) {
        $keyWordType = keywordClassification($q);
        $dataSearch  = search($keyWordType);
        $resultCheck = spellCheck($keyWordType,$q);
        $dataSendView = array(
            "dataSearch"  => $dataSearch,
            "q"           => $q,
            "resultCheck" => $resultCheck
        );
    } else {
        $dataSendView = array(
            "dataSearch"  => "",
            "q"           => "",
            "resultCheck" => array(
                "check" => 1,
                "q"     => ""
            ),
        );
    }
    load_view('index',$dataSendView);
}

function keywordClassification($q)
{
    if(checkProduct($q)) {
        $dataKeyWord  = array(
            "type" => "product",
            "q"    => $q
        );
    } else {
        $dataKeyWord = array();
        if(checkProdCat($q)) {
            $dataKeyWord  = array(
                "type" => "prodCat",
                "q"    => $q
            );
        } else {
            $listTradeMark = getListTradeMark();
            $nameTradeMark = "";
            foreach($listTradeMark as $tradeMarkItem) {
                if (strlen(strstr($q,$tradeMarkItem['name_trademark'])) > 0){
                    $nameTradeMark = $tradeMarkItem['name_trademark'];
                    $dataKeyWord  = array(
                        "type" => "tradeMark",
                        "q"    => $nameTradeMark
                    );
                }
            }
            if($nameTradeMark == "") {
                if(checkTradeMark($q)) {
                    $dataKeyWord  = array(
                        "type" => "tradeMark",
                        "q"    => $q
                    );
                }
            }
        }
        if(empty($dataKeyWord)) {
            $dataKeyWord  = array(
                "type" => "product",
                "q"    => $q,

            );
        }
    }
    return $dataKeyWord;
}