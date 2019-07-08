<?php

namespace App\Services;

class Google {

    private $_config;
    private $_data = array();
    private $_method = '';
    private $_url = '';

    public function __construct($config) {
        $this->_url = $config['url'];
        unset($config['url']);
        $this->_config = $config;
    }

    public function getData($searchText, $method = 'get') {
        $this->_method = strtoupper($method);
        $this->_data = [
            'q' => $searchText,
            'key' => $this->_config['key'],
            'cx' => $this->_config['cx'],
            'fields' => 'items(title,snippet,link)'
        ];

        return $this->request();
    }

    private function request() {
        $curl = curl_init();

        if ($this->_method == 'GET') {
            $this->_url = $this->_url . '?' . http_build_query($this->_data);
            $this->_data = '';
        }



        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => strtoupper($this->_method),
            CURLOPT_POSTFIELDS => $this->_data,
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);


        if ($err) {
            return array('status' => 0, 'message' => $err, 'data' => '');
        } else {
            return array('status' => 1, 'message' => 'sucess', 'data' => json_decode($response));
        }
    }

}
