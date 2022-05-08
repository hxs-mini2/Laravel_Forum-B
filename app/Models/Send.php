<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Send extends Model {
	public function insertComment($table, $name, $message) {
		$special_character_set = array (
			"&" => "&amp;",
			"<" => "&lt;",
			">" => "&gt;",
			" " => "&ensp;",
			"　" => "&emsp;",
			"\n" => "<br>",
			"\t" => "&ensp;&ensp;"
		);
		
		foreach ($special_character_set as $key => $value) {
			$message = str_replace($key, $value, $message);
		}

		DB::connection('mysql_keiziban')->insert(
			"INSERT INTO $table(no, name, message, time) VALUES(NULL, :name, :message, NOW())", 
			[$name, $message]);
		return null;
	}
}
