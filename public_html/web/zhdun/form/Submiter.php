<?

Class Submiter{
	private $data;
	private $accessfields=[
	'id',
	'title',
	'name',
	'secondname',
	'thirdname',
	'vk_id',
	'fb_id',
	'in_id',
	'foto',
	'birthday',
	'mail',
	'phone',
	'message',
	'about',
	'sex',
	'sale',
	'kino',
	'jazz',
	'rent',
	'lection',
	'marketing',
	'newsgr',
	'newsko',
	'newsnet',
	'notnewsyet',
	'notnews',
	'otkuda',
	'partner',
	'staff',
	'client',
	'other',
	'rent_date',
	'kolvo',
	'type',
	'utm_source',
	'utm_medium',
	'utm_campaign',
	'utm_content',
	'utm_term'];
	public function setData($data){
		if(is_array($data)){
			$this->data=$data;
		}
	}
	public function send($service){ //Отправка данных на адрес сервиса 
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_URL,  $service->getUrl().($service->method()=='get' ? '&'.http_build_query($service->getData($this->data)):''));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			if($service->method()=='post'){
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($service->getData($this->data)));
			}
			$out = curl_exec($curl);
			curl_close($curl);
		}
	}
	public function save($config){ // сохранение в нужную табличку
		if(isset($config) && sizeof($this->data)>0){
			$mysqli = new mysqli($config['server'], $config['uname'], $config['upass'], $config['db']);
			if ($mysqli->connect_errno) {
				 mail($config['tech'], "Ошибка связи с BD","Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
				 return false;
			}
			
			if(sizeof($this->data)>0){
				$fields=$this->data;//array_map("mysql_real_escape_string",$this->data);
				$fieldstr='';
				foreach($fields as $field=>$val){
					if(array_search($field,$this->accessfields)) $fieldstr.='`'.$field.'`=\''.$val.'\',';
				}
				$mysqli->set_charset("utf8");
				$mysqli->query("SET NAMES utf8");
				if(!$mysqli->query("INSERT INTO users SET ".trim($fieldstr,','))) {
					mail($config['tech'], "Не удалось сохранить в BD"," " . $mysqli->errno . " - " . $mysqli->error);
				}
				$mysqli->close();
			}
		}
	}
	public function toEmail($to,$subject,$template,$params=[]){ // отправка на email
		if(sizeof($this->data)>0){
		   $subject = '=?utf-8?b?'. base64_encode($subject) .'?=';
		   $headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
		   foreach($params as $param=>$val) $headers .= $param.": ". $val ."\r\n";
		   $headers .= "MIME-Version: 1.0\r\n";
		   $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
		   $message=file_get_contents($template);

			if(isset($_COOKIE['utm_source'])) $this->data['utm_source'] = $_COOKIE['utm_source'];
			if(isset($_COOKIE['utm_medium'])) $this->data['utm_medium'] = $_COOKIE['utm_medium'];
			if(isset($_COOKIE['utm_campaign'])) $this->data['utm_campaign'] = $_COOKIE['utm_campaign'];
			if(isset($_COOKIE['utm_content'])) $this->data['utm_content'] = $_COOKIE['utm_content'];
			if(isset($_COOKIE['utm_term'])) $this->data['utm_term'] = $_COOKIE['utm_term'];
			
		   foreach($this->data as $name=>$val) $message=str_replace('{{'.$name.'}}',$val,$message);
		   if(!mail($to, $subject, $message, $headers))
			  return false;  
			else  
			  return true;
		}
	}
}
?>