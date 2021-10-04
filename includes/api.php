<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('../includes/config.php');

$action = $_GET['action'];

if($action == 'getMesg'){
    $admin_id = $_GET['admin_id'];
    $teacher_id = $_GET['teacher_id'];
    $sql =mysqli_query($con,"SELECT * FROM messages where (sender_id={$admin_id} and recipient_id={$teacher_id}) or (sender_id={$teacher_id} and recipient_id={$admin_id})");
    $results = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($results);
    exit;
}
if($action == 'saveMsg'){
    
    $data = json_decode( file_get_contents('php://input'),true );
    $msg = $data['message'];
    $sender_id = $data['sender_id'];
    $recipient_id = $data['recipient_id'];
    mysqli_query($con,"insert into messages(sender_id,recipient_id,message,type) values($sender_id,$recipient_id,'$msg','text')");
    exit;
}
if($action == 'saveImg'){
    $image  = $_FILES["photo"];
    $sender_id = $_POST['sender_id'];
    $recipient_id = $_POST['recipient_id'];
    $folder = "../storage/"; 
    if ( !file_exists( $folder ) ) {
      @mkdir( $folder, 0755, true ) ;
    }
    $img_name = uniqid().$image["name"];
    $target = $folder.$img_name;
    move_uploaded_file( $image["tmp_name"], $target );
    $full_path = '/storage/'.$img_name;
    mysqli_query($con,"insert into messages(sender_id,recipient_id,message,type) values($sender_id,$recipient_id,'$full_path','image')");
    echo json_encode(['path'=>$full_path]);
    exit;

}
if($action =='saveMsgAudio'){
    $image  = $_FILES["audio"];
    $sender_id = $_POST['sender_id'];
    $recipient_id = $_POST['recipient_id'];
    $folder = "../storage/"; 
    if ( !file_exists( $folder ) ) {
      @mkdir( $folder, 0755, true ) ;
    }
    $img_name = uniqid().$image["name"].'.mp3';
    $target = $folder.$img_name;
    move_uploaded_file( $image["tmp_name"], $target );
    $full_path = '/storage/'.$img_name;
    mysqli_query($con,"insert into messages(sender_id,recipient_id,message,type) values($sender_id,$recipient_id,'$full_path','audio')");
    echo json_encode(['path'=>$full_path]);
    exit;
}



