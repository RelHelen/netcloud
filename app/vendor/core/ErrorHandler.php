<?php

/**
 * Сохраняем логи в файл /tmp/errors.log
 */

namespace app\vendor\core;
//этап разработки - показывм все ошибки DEBUG=1
//этап продакшн - скрываем все ошибки DEBUG=0
// habr.com/ru/post/161483/

//define("DEBUG",1);
//define("DEBUG",0);
// class NotFoundExeption extends Exception{
// 	public  function __construct($message='',$code=404){
// 		parent::__construct($message,$code);
// 	}
// }
class ErrorHandler
{

	public function __construct()
	{
		if (DEBUG) {
			error_reporting(-1); //все ошибки PHP попадут в отчет
		} else {
			error_reporting(0); //скрывать ошибки
		}
		set_error_handler([$this, 'errorHandler']);
		ob_start();
		register_shutdown_function([$this, 'fatalErrorHandler']);
		set_exception_handler([$this, 'exceptionHandler']);
	}
	/**
	 * Обработчик нефатальных ошибок
	 * @param int $errno уровень ошибки
	 * @param string $errstr сообщение об ошибке
	 * @param string $errfile имя файла, в котором произошла ошибка
	 * @param int $errline номер строки, в которой произошла ошибка
	 * @return boolean
	 */
	public function errorHandler($errno, $errstr, $errfile, $errline)
	{
		//сохраняем логи ошибки
		//error_log("[".date('Y-m-d H:i:s') ."] Ошибка: {$errstr} || Файл: {$errfile} || Строка: {$errline} \n ====****=====================\n",3,__DIR__.'/errors.log');
		$this->logErrors($errstr, $errfile, $errline);



		if (DEBUG || in_array($errno, [E_USER_ERROR, E_RECOVERABLE_ERROR])) {
			$this->displayError($errno, $errstr, $errfile, $errline);
		}
		return true;
	}

	/**
	 * Выявление фальных  ошибки
	 */
	public function fatalErrorHandler()
	{
		$error = error_get_last(); //последняя ошибка, которая вызвала прерывание сценария
		if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
			//error_log("[".date('Y-m-d H:i:s') ."] Ошибка: {$error['message']} || Файл: {$error['file']} || Строка: {$error['line']} \n ====****=====================\n",3,__DIR__.'/errors.log');
			$this->logErrors($error['message'], $error['file'], $error['line']);

			// очищаем буффер (не выводим стандартное сообщение об ошибке)
			ob_end_clean();
			// запускаем обработчик ошибок
			$this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
		} else {
			// отправка (вывод) буфера и его отключение
			ob_end_flush();
		}
	}

	/**
	 * Выявление исключений
	 */
	public function exceptionHandler($e)
	{

		//сохраняем логи ошибки
		//error_log("[".date('Y-m-d H:i:s') ."] Ошибка исключения: {$e->getMessage()} || Файл: {$e->getFile()} || Строка: {$e->getLine()} \n ====****=====================\n",3,__DIR__.'/errors.log');

		//1044 ошибка при подключении к бд
		if ($e->getCode() == 1044) {
			error_log("[" . date('Y-m-d H:i:s') . "] Ошибка исключения: {$e->getMessage()} || Файл: {$e->getFile()} || Строка: {$e->getLine()} \n ====****=====================\n", 3, APP . '/tmp/errorbd.log');
		};
		$this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());




		$this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
	}

	/**
	 * Logs ошибок
	 * */
	protected function logErrors($errstr = '', $errfile = '', $errline = '')
	{
		//сохраняем логи ошибки
		error_log("[" . date('Y-m-d H:i:s') . "] Ошибка: {$errstr} || Файл: {$errfile} || Строка: {$errline} \n ====****=====================\n", 3, APP . '/tmp/errors.log');
	}

	/**
	 * Вывод ошибок
	 * */
	protected function displayError($errno, $errstr, $errfile, $errline, $response = 500)
	{

		http_response_code($response); //отправляем код ответа	 
		if ($response == 403) {
			require WWW . '/errors/404.php';
			die;
		}
		if ($response == 404 && !DEBUG) {
			require WWW . '/errors/404.php';
			die;
		}
		if (DEBUG) {
			require WWW . '/errors/devs.php';
		} else {
			require WWW . '/errors/prod.php';
		}
		die;
	}
}
//проверкка ошибок
new ErrorHandler;
	//echo $test;
	//tes();
	//throw new Exception("Страница не надена",404);
	//throw new NotFoundExeption('Страница не надена');
;
