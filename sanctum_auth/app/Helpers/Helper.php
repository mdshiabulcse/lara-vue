<?php




function send_ms($msg,$status, $code){
 return  $response=[
        'status'=> $status,
        'message'=> $msg,
     
    ];
    return response()->json($response, $code);
};


?>