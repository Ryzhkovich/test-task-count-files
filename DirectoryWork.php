<?php

include_once('FileParsing.php');

class DirectoryWork {

	public $dir;

	private $files;

	private $sum;

	public function __constructor($dir, $files, $sum) {

		$this->dir = $dir;

		$this->files = $files;

		$this->sum = $sum;

	}

	public function getDir() {

		return $this->dir;

	}

	public function setDir($dir) {

		$this->dir = $dir;

	}

	public function getFiles() {

		return $this->files;

	}

	public function setFiles($files) {

		$this->files = $files;

	}

	public function getSum() {

		return $this->sum;

	}

	public function addToSum($add) {

		$this->sum += $add;

	}

	public function setSum($sum) {

		$this->sum = $sum;

	}

	public function buildDirectoriesTree($startDir, $level) {

		$arrDirs = scandir($startDir);

		$this->setFiles($arrDirs);

		$arrData = $this->getFiles($arrDirs);

		foreach ($arrData as $key => $value) {

			if ($key > 1) {

				$res = $startDir . $value;

				if (is_dir($res)) {

					echo str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level) . "<span style=\"color: red\">" . $value . "</span>" . "<br />";

					$this->buildDirectoriesTree($res . '/', $level + 1);			

				} else {

					if (FileParsing::parseFileName($value)) {

						$result = FileParsing::getFileSum(FileParsing::parseNumber($res));

						echo str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level + 1) . "<span style=\"color: green\">" . $value . "</span>" . ' - ' .  "<span style=\"color: orange\">" . $result . "</span>" . "<br />";

						$this->addToSum($result);

					} else {

						echo str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level + 1) . "<span style=\"color: blue\">" . $value . "</span>" . "<br />";

					}

				}
			}
		}
	}
}