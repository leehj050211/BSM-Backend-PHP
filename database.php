<?php
  $root_dir=$_SERVER['DOCUMENT_ROOT'];
  $dir='./db_commands';
  require_once "session.php";
  if(isset($_POST['returnUrl'])){
    $returnUrl = $_POST['returnUrl'];
  }else{
    $returnUrl = '/';
  }
  require_once "database_connect.php";
  require_once "database_function.php";
  function memberLevel(){
    $members_level=array();
    $members_level_query="SELECT `member_code`, `member_level` FROM `members` WHERE `member_level`>0";
    $result = db($members_level_query);
    for($i=0;$i<$result->num_rows;$i++){
        $member=$result->fetch_array(MYSQLI_ASSOC);
        $members_level[$member['member_code']]=$member['member_level'];
    }
    return $members_level;
  }
  $command_type = $_POST['command_type'];
  switch($command_type){
    case 'is_login':
      require_once $dir.'/is_login.php';
      break;
    case 'version':
      require_once $dir.'/version.php';
      break;
    case 'login':
      require_once $dir.'/login.php';
      break;
    case 'modify':
      require_once $dir.'/modify.php';
      break;
    case 'register':
      require_once $dir.'/register.php';
      break;
    case 'reset_pw':
      require_once $dir.'/reset_pw.php';
      break;
    case 'authentication':
      require_once $dir.'/authentication.php';
      break;
    case 'valid_code':
      require_once $dir.'/send_valid_code.php';
      break;
    case 'member':
      require_once $dir.'/member.php';
      break;
    case 'search':
      require_once $dir.'/search.php';
      break;
    case 'board':
      require_once $dir.'/board/board_view.php';
      break;
    case 'post':
      require_once $dir.'/board/post_view.php';
      break;
    case 'post_write':
      require_once $dir.'/board/post_write.php';
      break;
    case 'post_delete':
      require_once $dir.'/board/post_delete.php';
      break;
    case 'comment':
      require_once $dir.'/board/comment_view.php';
      break;
    case 'comment_write':
      require_once $dir.'/board/comment_write.php';
      break;
    case 'comment_delete':
      require_once $dir.'/board/comment_delete.php';
      break;
    case 'like':
      require_once $dir.'/board/like.php';
      break;
    case 'food':
      require_once $dir.'/food.php';
      break;
    case 'timetable':
      require_once $dir.'/timetable.php';
      break;
    case 'meister':
      require_once $dir.'/meister.php';
      break;
    default:
      statusCode(2);
    break;
  }
?>