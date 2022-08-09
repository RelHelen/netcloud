<?php

namespace fw\widgets\menu;

use fw\libs\Cache;

class Menu
{
	protected $data;
	protected $tree; //постоение дерева меню
	protected $menuHtml; //вывод html меню
	protected $tpl = __DIR__ . '/menu_tpl/menu.php'; //путь к шаблону для постоения кода меню
	protected $container = 'ul'; //в какой тег оборачиваем меню
	protected $class = 'menu'; //класс для $container
	protected $table = 'testcategory'; //подключаемая таблица
	protected $cacheTime = false; //время кеширования

	public function __construct($options = [])
	{
		$this->getOptions($options);
		$this->run();
	}

	protected function getOptions($options)
	{
		foreach ($options as $key => $val) {
			if (property_exists($this, $key)) {
				$this->$key = $val;
			}
		}
	}


	//вызов
	protected function run()
	{
		//получаем массив данных


		if ($this->cacheTime) {
			//echo 'есть кеш';
			$cache = new Cache();
			//получаем из кеш
			$this->menuHtml = $cache->get('fw_menu');

			if (!$this->menuHtml) {
				$this->data = \R::getAssoc("SELECT * FROM {$this->table}"); //ключами являются id
				$this->tree = $this->getTree();
				//debug($this->tree);
				$this->menuHtml = $this->getMenuHtml($this->tree);
				$cache->set('fw_menu', $this->menuHtml, $this->cacheTime);
			}
		} else {
			//	echo 'нет кеш';
			$this->data = \R::getAssoc("SELECT * FROM {$this->table}"); //ключами являются id
			$this->tree = $this->getTree();
			//debug($this->tree);
			$this->menuHtml = $this->getMenuHtml($this->tree);
		}
		$this->outputMenu();
	}

	//обертка
	protected function outputMenu()
	{
		echo "<{$this->container} class='{$this->class}'>";
		echo $this->menuHtml;
		echo "</{$this->container}>";
	}


	//формируем дерево
	protected function getTree()
	{
		$tree = [];
		$data = $this->data;

		foreach ($data as $id => &$node) {
			if (!$node['parent']) {
				$tree[$id] = &$node;
			} else {
				$data[$node['parent']]['childs'][$id] = &$node;
			}
		}
		return $tree;
	}

	//построение html кода меню
	protected function getMenuHtml($tree, $tab = '')
	{
		$str = '';
		foreach ($tree as $id => $category) {
			$str .= $this->catToTemplate($category, $tab, $id);
		}
		return $str;
	}

	//отправка категории в шаблон
	protected function catToTemplate($category, $tab, $id)
	{
		ob_start();
		require $this->tpl; //подключаем шаблон
		return ob_get_clean();
	}
}
