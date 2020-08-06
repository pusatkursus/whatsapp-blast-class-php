<?php
//wablas API class
//https://ampel.wablas.com/documentation
//server whatsapp disesuaikan pada saat pesan
//token ada pada tombol setting
//untuk menjalankan pertama kali harus generate qrcode dan scan pada menu device di wablac
class wablas{

    private $token;
 
    public function __construct() {
       
        $this->token = "TOKEN KAMU";
    }

    function kirim_wa($phone,$message)
    {

        $curl = curl_init();
        $data = [
            'phone' => $phone,
            'message' => $message,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function simple_wa($phone, $message){
        $resutl = file_get_content("https://ampel.wablas.com/api/send-message?token=".$this->token."&phone=".$phone."&message=".$message);
        echo "<pre>";
        print_r($result);
    }

    function send_group($groupId, $phone, $message){
        $curl = curl_init();
        $data = [
            'groupId' => $groupId,
            'phone' => $phone,
            'message' => $message,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization:".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-group");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function send_image($phone, $caption, $urlImage){
        $curl = curl_init();
        $data = [
            'phone' => $phone,
            'caption' => $caption, // can be null
            'image' => $urlImage,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-image");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function send_image_lokal($phone, $caption){

        $filename = $_FILES['upload_file']['tmp_name'];
        $handle = fopen($filename, "r");
        $file = fread($handle, filesize($filename));

        $params = [
            'phone' => $phone,
            'caption' => $caption, // can be null 
            'file' => base64_encode($file),
            'data' => json_encode($_FILES['upload_file'])
        ];

        /**
         * bulk message
        $params = [
            'phone' => '081XXXXXX91,0850011xxx',
            'caption' => 'hi', // can be null 
            'file' => base64_encode($file),
            'data' => json_encode($_FILES['upload_file'])
        ];
        */

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [ "Authorization:".$this->token ] );
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-image-from-local");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function send_image_group(){
        $curl = curl_init();
        $data = [
            'groupId' => '154xxxxx',
            'phone' => '081XXXXXXX',
            'caption' => 'hi', // can be null
            'image' => 'https://xxxx.com/poster.png',
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-image-group");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function send_image_from_image($groupId, $phone, $caption){
        $filename = $_FILES['upload_file']['tmp_name'];
        $handle = fopen($filename, "r");
        $file = fread($handle, filesize($filename));

        $params = [
            'groupId' => $groupId,
            'phone' => $phone,
            'caption' => $caption, // can be null 
            'file' => base64_encode($file),
            'data' => json_encode($_FILES['upload_file'])
        ];

        /**
         * bulk message
        $params = [
            'phone' => '081XXXXXX91,0850011xxx',
            'caption' => 'hi', // can be null 
            'file' => base64_encode($file),
            'data' => json_encode($_FILES['upload_file'])
        ];
        */

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [ "Authorization: ".$this->token ] );
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-image-from-local");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function send_document($phone, $caption, $url){
        $curl = curl_init();
        $data = [
            'phone' => $phone,
            'caption' => $caption, // can be null
            'document' => $url
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-document");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function send_document_group($groupId, $phone, $caption, $url){
        $curl = curl_init();
        $data = [
            'groupId' => $groupId,
            'phone' => $phone,
            'caption' => $caption, // can be null
            'document' => $url,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-document-group");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function send_video($phone, $caption, $urlVideo){
        $curl = curl_init();
        $data = [
            'phone' => $phone,
            'caption' => $caption, // can be null
            'video' => $urlVideo,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-video");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function schedule($phone, $message, $date, $time){
        $curl = curl_init();
        $data = [
            'phone' => $phone,
            'message' => $message,
            'date' => $date,
            'time' => $time,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/schedule");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function report($fromDate, $toDate ){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/report?from=".$fromDate."&to=".$toDate);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function receive(){
        /**
         * all data POST sent from https://ampel.wablas.com
         * you must create URL what can receive POST data
         * we will sent data like this: 
         * id = message ID - string
         * phone = sender phone - string
         * message = content of message - text
         * pushName = Sender Name like contact name - string
         * groupId = Group ID if message from group - string
         * groupSubject = Group Name - string
         * timestamp = time send message - integer
         * image = name of the image file when receiving image message
         * file = name of the file file when receiving document/video message
         * url = URL of image/document/video
         */
        $post = extract($_POST);

        /**
         * Save to database table inbox
         */
        $conn = new mysqli("localhost", "user123", "password123", "bot_db");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO inbox (message_id, phone, message)
        VALUES ($post[message_id], $post[phone] $post[message])";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "" . $conn->error;
        }
        if($conn->close()) {
            echo null;
        }

    }

    function autoReply(){
        extract($_POST);
        /**
         * for auto reply or bot 
         */
        
        echo "your phone: $phone \n";

        if($message == 1 ) {
            echo "your message: $message";
        } else {
            echo "I am still learning";
        }
    }

    function extract(){
        $result = extract($_POST);
        echo "<pre>";
        print_r($result);
    }

    function send_sms($phone, $message){
        $curl = curl_init();
        $token = "";
        $data = [
            'phone' => $phone,
            'message' => $message,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: ".$this->token,
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/sms/send");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        echo "<pre>";
        print_r($result);
    }

    function forward_sms(){
        /**
         * all data POST sent from https://ampel.wablas.com
         * you must create URL what can receive POST data
         * we will sent data like this: 
         * id = message ID - string
         * phone = string
         * message = string
         * device_id = string
         */
        $data = extract($_POST);
        echo "<pre>";
        print_r($data);
    }

    function finger_print(){
        /**
         * all data POST sent from https://ampel.wablas.com
         * you must create URL what can receive POST data
         * we will sent data like this: 
         * serial_number = string
         * data = string
         */
        $result = extract($_POST);
        echo "<pre>";
        print_r($result);
    }
}
    //cara pakai
    //$wa = new wablas(); //inisiasi class
    //gunakan salah satu fungsi di wablas
    //$wa->kirim_wa('6285793909203','Tes Pake Class Api');
?>