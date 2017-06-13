<?
namespace app;

require(__DIR__ . '/form/autoload.php');
require(__DIR__ . '/form/config.php');
use Submiter;

$submiter=new Submiter;

$submiter->setData($_POST);

if($submiter->toEmail(
	'rent@goodrepublic.ru, vitalhit@gmail.com, v@goodrepublic.ru, alena@goodrepublic.ru, myasnushki@gmail.com', //Почта для отправления
	"Форма с goodrepublic.ru - ".date('j F Y h:i A'), // Заголовок
	'./form/mail.twig', //Шаблон письма в формате twig
	['From'=>'goodrepublic@goodrepublic.ru'])){
		echo 'sent';
	} //Дополнительные заголовки
$submiter->save($config); //Сохранение в базу данных

?>