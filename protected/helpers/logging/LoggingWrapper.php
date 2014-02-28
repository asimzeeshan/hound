<?php
// Using YiiFramework Logging mechanism
// http://www.yiiframework.com/doc/guide/1.1/en/topics.logging
class LoggingWrapper {
	public static function Info($message) {
		Yii::log($message, 'info');
	}
	
	public static function Warning($message) {
		Yii::log($message, 'warning');
	}
	
	public static function Error($message) {
		Yii::log($message, 'error');
	}
	
	// backward compatibility with logentries library that im removing NOW
	public static function Debug($message) {
		$this->Info($message);
	}
	
	// backward compatibility with logentries library that im removing NOW
	public static function Notice($message) {
		$this->Info($message);
	}
	
	// backward compatibility with logentries library that im removing NOW
	public static function Emerg($message) {
		$this->Info($message);
	}
}
?>