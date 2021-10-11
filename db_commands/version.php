<?php
if ($_POST['os']==NULL||$_POST['app']==NULL) {
    $json = json_encode(array('status' => 2));
    echo $json;
    exit();
}else{
    switch($_POST['app']){
        case 'web':
            $json = json_encode(array('status' => 1, 'versionCode' => 1, 'versionName' => '0.5'));
            echo $json;
            break;
        case 'app':
            switch($_POST['os']){
            case 'android':
                $json = json_encode(array('status' => 1, 'versionCode' => 3, 'versionName' => 'Beta 0.2'));
                echo $json;
                break;
            default:
                $json = json_encode(array('status' => 2));
                echo $json;
                break;
            }
            break;
        default:
            $json = json_encode(array('status' => 2));
            echo $json;
            break;
    }
}
?>