<?
	namespace services;
	
	Class MyService extends Service{
		protected $url='';   
		protected $data;
//		protected $mainfields=['name', 'phone_number', 'email', 'message'];

		public function getData($data){
			if(isset($data['name'])) $this->data['name'];
			if(isset($data['phone_number'])) $this->data['phone_number']=$data['phone_number'];
			if(isset($data['email'])) $this->data['email']=$data['email'];
			$this->data['message']=''.$this->composeOtherData($data);
			return $this->data;
		}
	}