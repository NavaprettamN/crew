<?php 
    @include('../login/config.php');
    session_start();
    if(isset($_POST['submit'])) {
        $nid = $_POST['nid'];
        $did = $_POST['did'];
        $sel = "UPDATE notify SET drvad=1 WHERE nid=$nid";
        $res = mysqli_query($conn, $sel);
        $sel1="UPDATE vacancy SET available=available-1 where available>0 and did=$did;";
        $a1="SELECT uid FROM notify WHERE did=$did And nid=$nid;";
        $b1=mysqli_query($conn, $a1);
        $c1=$b1->fetch_assoc();
        $uid=$c1['uid'];
        $a2="SELECT uphone FROM user WHERE `uid`=$uid;";
        $b2=mysqli_query($conn, $a2);
        $c2=$b2->fetch_assoc();
        $uphone=$c2['uphone'];
        $res1=mysqli_query($conn, $sel1);
        header('location:./ong.php');
    }
    $params=array(
        'token' => 'c4m65s5dw2dt5qpf',
        'to' => $uphone,
        'body' => '🎉🎉Congratulations!! Your request for the ride has been accepted.✅✅'
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ultramsg.com/instance51272/messages/chat",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => http_build_query($params),
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
?>