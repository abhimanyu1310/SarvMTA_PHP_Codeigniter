<?php

class EmailTest extends CI_Controller {

    public function index() {
        echo 'Hello From Test!';
    }

    public function sendMail() {
        $this->load->library("Sarv");
        $owner_id = 'owner_id';
        $apiToken = 'token';
        $SarvTES_APP_DOMAIN = 'SarvTES_APP_DOMAIN';
        $smtp_user_name = "smtp12345";
        $this->sarv->init($owner_id, $apiToken, $SarvTES_APP_DOMAIN); //You must call this method once before any other method call
        $recipients = array(
            array(
                'email' => 'recipient1.email@example.com',
                'name' => 'Recipient1 Name'
            ),
            array(
                'email' => 'recipient2.email@example.com',
                'name' => 'Recipient2 Name'
            )
        );
        foreach ($recipients as $recipient) {
            $message = array();
            $message["html"] = "Example HTML content";
            $message["text"] = "Example text content";
            $message["subject"] = "example subject";
            $message["from_email"] = "from_email@example.com";
            $message["to"] = array(
                array("email" => $recipient['email'], "name" => $recipient['name'], "type" => "to")
            );
            $message["headers"] = array("Reply-To" => "message.reply@example.com", "X-Unique-Id" => "Id");
            $message["attachments"] = array(array("type" => "text/plain", "name" => "myfile.txt", "content" => "ZXhhbXBsZSBmaWxl"));
            $message["images"] = array(array("type" => "image/png", "name" => "IMAGECID", "content" => "dgfdddger"));

            $result = $this->sarv->messages->sendMail($smtp_user_name, $message);
            print_r($result);
            /*
              Array
              (
              [status] => "success"
              [message] => "message have been Queued ... "
              )
             */
        }
    }

}
