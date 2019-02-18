<?php
/**
 * Domai CMS
 * 哆麦内容管理系统 
 * Copyright @2018 Hito
 *
 * Domai CMS发布时间更新插件
 * @date 2019年2月18日
 */
require_once('dm-load.php');

$day = isset($_GET['day']) ? (int) $_GET['day'] : 0;


//开始的时间
$start_date = '2017-01-02';

//每天的文章数量
$posts_per_day = 15;


$starttime = strtotime($start_date);
for($i = 0; $i < $posts_per_day; $i++){

    $id = $posts_per_day*$day + $i;
    
    $seconds = rand(0, 86400);
    $mtime = strtotime("+$day days $seconds seconds", $starttime);
    $datetime = date('Y-m-d H:i:s', $mtime);
    $modifiedtime = date('Y-m-d H:i:s', $mtime + rand(0, 36000));
    $dmdb->query("update ##_posts set post_date = '$datetime', post_modified = '$modifiedtime' where ID = $id");
}


$day++;
$isexists = $dmdb->get_var('select post_title from ##_posts where ID = '.$id);

if($isexists){
    echo sprintf("<meta http-equiv='Refresh' content='0,url=./modifie.php ?day=%d'><br/>更新第%d天", $day, $day);

}else{
    echo '更新完成';
}
