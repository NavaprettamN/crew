<?php 
@include('../login/config.php');
    // if(isset($_SESSION['tripid'])&&isset($_SESSION['uid'])) {
    if(isset($_POST['submit'])) {
        $tripid = $_POST['tripid'];
        $uid = $_POST['uid'];
        $a1 = "SELECT * FROM trip WHERE tripid=$tripid;";
        $b1= mysqli_query($conn,$a1);
        $c1 = $b1->fetch_assoc();
        $did = $c1['did'];
        $strt = $c1['strt'];
        $a2 = "INSERT INTO notify(tripid,`uid`,did,strt,usrad) Values($tripid,$uid,$did,'$strt',1);";
        $b2 = mysqli_query($conn,$a2);
        $a3="SELECT dphone from driver WHERE did=$did";
        $b3=mysqli_query($conn, $a3);
        $c3=$b3->fetch_assoc();
        $dphone=$c3['dphone'];
        echo $dphone;
        $params=array(
            'token' => 'c4m65s5dw2dt5qpf',
            'to' => $dphone,
            'body' => 'You got a humsafar ☺☺ for the trip. Accept the invitation.✅✅'
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
        header('location: ./request.php');
    } else {
        echo 'err';
    }
?>