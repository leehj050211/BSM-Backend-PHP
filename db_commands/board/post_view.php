<?php
if($_POST['boardType']==null){

}else{
    switch ($_POST['boardType']){
        case 'board':
        if(!(isset($_SESSION['member_code']))){
            $json = json_encode(array('status' => 21));
            echo $json;
            exit();
        }
        $boardType=$_POST['boardType'];
        $like_boardType='board_like';
        break;
        case 'blog':
        $boardType=$_POST['boardType'];
        $like_boardType='blog_like';
        break;
        case 'music':
        $boardType=$_POST['boardType'];
        $like_boardType='music_like';
        break;
    }
    if ($_POST['post_no']==null) {
        $json = json_encode(array('status' => 17));
        echo $json;
        exit();
    }else{
        $post_no = $_POST['post_no'];
        $post_query = "SELECT * from $boardType where post_no=$post_no";
        $result = db($post_query);
        $post=$result->fetch_array(MYSQLI_ASSOC);
        if($post['post_deleted']==0){
        $post_hit_query = "UPDATE $boardType set post_hit=post_hit+1 where post_no=$post_no";
        db($post_hit_query);
        $post_title=htmlspecialchars($post['post_title'],ENT_QUOTES,'UTF-8');
        $post_content=$post['post_content'];
        $member_code=$post['member_code'];
        $member_nickname=$post['member_nickname'];
        $post_comments=$post['post_comments'];
        $post_hit=$post['post_hit'];
        $post_date=$post['post_date'];
        $post_like=$post['like'];

        $like_check_query = "SELECT `like` FROM `$like_boardType` WHERE `post_no`= $post_no AND `member_code`=".$_SESSION['member_code'];
        $result = db($like_check_query);
        if($result->num_rows){
            $like_check = db($like_check_query)->fetch_array(MYSQLI_ASSOC);
            $like=$like_check['like'];
        }else{
            $like=0;
        }
        $json = json_encode(array('status' => 1, 'post_title' => $post_title, 'post_content' => $post_content, 'member_code' => $member_code, 'member_nickname' => $member_nickname, 'post_comments' => $post_comments, 'post_hit' => $post_hit, 'post_like' => $post_like, 'like' => $like, 'post_date' => $post_date));
        echo $json;
        }else{
        $json = json_encode(array('status' => 18));
        echo $json;
        }
    }
}
?>