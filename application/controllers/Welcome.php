<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function example_api()
    {
		/* EXAMPLE: DATA dari database dan form input data berupa ARRAY */
		/**
		 * message = bisa juga sebagai caption
		 * isMedia = TRUE jika ada, FALSE jika tidak ada media (image, document, video)
		 * typeMedia = text; image; document; video 
		 * urlMedia = url media yang sudah di-upload sebelumnya (contoh url media image: http://website.com/img/WA.png) (MAXIMAL SIZE MEDIA 2MB, jika melebihi size maka gunakan text dengan lampiran URL media)
         * 
         * Ekstensi yang dibolehkan: jpg, jpeg, png, pdf, mp4
		 */
        $data_example = array( 
			array("MSISDN" => "628000006660", "NAMA" => "ROMA 01", "isMedia" => false, "typeMedia" => "text", "urlMedia" => ""), 
			// array("MSISDN" => "628000006660", "NAMA" => "ROMA 02", "isMedia" => true, "typeMedia" => "image", "urlMedia" => "http://website.com/upload/image.jpg"), /** Example kirim Image */
			// array("MSISDN" => "628000006660", "NAMA" => "ROMA 03", "isMedia" => true, "typeMedia" => "document", "urlMedia" => "http://website.com/upload/document.pdf"), /** Example kirim document */ /** DOKUMEN tidak memiliki CAPTION, pilih opsi kirim via TEXT */
			// array("MSISDN" => "628000006660", "NAMA" => "ROMA 03", "isMedia" => true, "typeMedia" => "video", "urlMedia" => "http://website.com/upload/video.mp4"), /** Example kirim video */
			// array("MSISDN" => "628000006660", "NAMA" => "ROMA 01", "isMedia" => "", "typeMedia" => "", "urlMedia" => ""), /** Contoh data kosong seperti ini akan mengirim sebuah TEXT secara default! */
		);

        $data = array(
            'name' => 'SAYA'
        );
        $message = $this->load->view('welcome_message', $data, TRUE); /** message bisa juga sebagai caption untuk media */

        /* Lalu buat jadi bentuk JSON */
        $stack = array();
        foreach ($data_example as $val) {
			array_push($stack, array("number" => $val['MSISDN'],  /** Nomor Employee */
												   "message" => $message." ".$val['NAMA'],  /** Pesan WA, bisa juga menjadi CAPTION (caption hanya untuk IMAGE & VIDEO) */
												   "isMedia" => $val['isMedia'],  /** TRUE jika ada MEDIA, FALSE jika tidak ada */
												   "typeMedia" => $val['typeMedia'],
												   "urlMedia" => $val['urlMedia'])
			);
        }
        $data_pesan = json_encode(array('messageList' => $stack ));

        // Mulai membuat token JWT, beri nama website yang akan mengakses API. Bisa tes token JWT di https://jwt.io/
		$access_token = token_request('GantiCodeName'); // example nama website (code_name: adalah kode nama website yang sudah didaftarkan dan dibolehkan untuk mengakses API MASTER)

        /* Mulai mengirim semua data yang diperlukan ke API */
        $postData = array(
               'data' => $data_pesan,
               //'access_token' => $access_token // kirim $access_token optional
        );

        $response = jwt_request('GantiUrlMaster', $postData, $access_token);

        /** Output respone yang bisa diambil:
            * message: string
			* status: boolean (true or false)
			* type: danger; success, warning, info
			*/

        $resArr = json_decode($response);
        //echo $resArr->status." --- ".$resArr->message;

        var_dump($response);
    }
}
