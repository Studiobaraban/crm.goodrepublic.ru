<?
namespace services;
	
Class Service{
	protected $url;
	protected $data;
	protected $method='post'; //По умолчанию отправка POST
	protected $mainfields=['name', 'phone_number', 'email', 'message']; //Основные поля
	public function getData($data){ // Получение данных для отправки на сервис
		return $this->data;
	}
	protected function composeOtherData($data){ //Собирание неиспользованных значений в строку
			$message='';
			foreach($data as $field=>$val){
				if(!array_search($field,$this->mainfields)) $message.=$field.': '.$val."\n\r";
			}
			return $message;
	}
	public function getUrl(){ // Получение ссылки на сервис
		return $this->url; 
	}
	public function method(){ // Получение типа отправки
		return $this->method; 
	}
}
?>