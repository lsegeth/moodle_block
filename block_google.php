<?php
class block_google extends block_base {
	public function init() {
		$this->title = get_string('google', 'block_google');
	}

	public function send_get() {
		$api_key = file_get_contents('api_key', true);
		$search_query = "moodle%20blocks";
		$url = 'https://www.googleapis.com/customsearch/v1?key='. substr($api_key, 0, -1) .'&cx=017576662512468239146:omuauf_lfve&q='. $search_query .']';

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_HEADER, 0);
  		curl_setopt($curl, CURLOPT_VERBOSE, 0);
  		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, $url);
  		$response = curl_exec($curl);
  		curl_close($curl);

		return $response;
	}

	public function get_content() {
		if ($this->content !== null) {
			return $this->content;
		}

		

		$this->content		= new stdClass;
		$this->content->text	= $this->send_get();

		return $this->content;
	}
}
