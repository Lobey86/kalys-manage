<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_config;
    
    /**
     * Создание конфигурации
     *
     */
    public function _initConfig ()
    {
        $config = new Zend_Config($this->getOptions(), true);
        $this->_config = $config;
        
        Zend_Registry::set('config', $config);
        
        return $config;
    }
	/**
     * Старт кеширования
     *
     * @return Объект кеша
     */
    public function _initCache ()
    {
        $cache = Zend_Cache::factory('Core', 'File', array('lifetime' => 120 , 'automatic_serialization' => true), array('cache_dir' => $this->_config->path->cache));
        Zend_Registry::set('cache', $cache);
        return $cache;
    }
    /**
     * Кеширование метаданных таблицы
     * @return unknown_type
     */
    public function _initDbMetadataCache ()
    {
        $this->bootstrap('cache');
        $cache = $this->getResource('cache');
        Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);
    }
    public function _initDbProfiler ()
    {
        if (APPLICATION_ENV == 'development' ){
            $profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
            $profiler->setEnabled(true);
            $this->bootstrap('db');
            $db = $this->getResource('db');
            $db->setProfiler($profiler);
            return $profiler;
        }
    }

	/**
     * Старт сессии
     *
     */
    public function _initSession ()
    {
    	//Zend_Session::setOptions(array('remember_me_seconds' => 864000));
        Zend_Session::start();
    }
    /**
     * Настройка загрузчика
     *
     * @return Объект авотозагрузчика
     */
    public function _initLoader ()
    {
        // Запуск автозагрузки
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Artgroup');
        
        // Загрузка Settings модуля
		new Zend_Application_Module_Autoloader(array('namespace' => 'Settings',
			'basePath' => $this->_config->path->modules . '/settings')
		);
		

        return $autoloader;
    }
    /**
     * Настройка локали
     *
     */
	public function _initLocale ()
	{
		// Установка локали
		$this->bootstrap('cache');
		$locale = new Zend_Locale('auto');
		$locale->setCache($this->getResource('cache'));
		
		Zend_Registry::set('Zend_Locale', $locale);
		return $locale;
	}
    protected function _initTranslate()
    {
        $registry = Zend_Registry::getInstance();
        
        $this->bootstrap('cache');
        Zend_Translate::setCache($this->getResource('cache'));
        
        $translate = new Zend_Translate('gettext',
            $this->_config->path->languages, null,
            array(
            'scan' => Zend_Translate::LOCALE_DIRECTORY,
            'disableNotices' => true,
            'logUntranslated' => false,
            )
        );
        $translate->setLocale('en_GB');
        $registry->set('Zend_Translate', $translate);
        return $translate;
    }
	
    /**
     * Настройка маршрутов
     *
     * @return Объект роутера
     */
    public function _initRouter ()
    {
        
        $this->bootstrap('locale');
        $router = new Zend_Controller_Router_Rewrite();
        
        // Если переменная router не является объектом Zend_Controller_Router_Abstract, выбрасываем исключение
        if (! ($router instanceof Zend_Controller_Router_Abstract)) {
            throw new Exception('Incorrect config file: Routes');
        } else {
            $this->bootstrap('frontController');
            $frontController = $this->frontController;
            $frontController->setRouter($router);
            
            return $router;
        }
    }
    /**
     * Настройка вида
     *
     * @return Объект вида
     */ 
    public function _initView() 
    {
        // Инициализация Zend_Layout, настройка пути к макетам, а также имени главного макета.
        // Параметр layout указан лишь для примера, по умолчанию имя макета именно "layout"
        Zend_Layout::startMvc(array(
            'layoutPath' => $this->_config->path->layouts,
            'layout' => 'layout',
        ));

        // Получение объекта Zend_Layout
        $layout = Zend_Layout::getMvcInstance();

        // Инициализация объекта Zend_View
        $view = $layout->getView();
        
        $view->setEncoding($this->_config->common->charset);

        // Настройка расширения макетов
        $layout->setViewSuffix('phtml');
		
		$this->bootstrap('db');
		$this->bootstrap('cache');
		$cache = $this->getResource('cache');
		


        
		$view->addHelperPath('Artgroup/View/Helper', 'Artgroup_View_Helper');

        // Установка объекта Zend_View
        $layout->setView($view);
		
		// Добавление хелпера доступа к Контроллеру и действиям
		//Zend_Controller_Action_HelperBroker::addHelper(new Artgroup_Controller_Action_Helper_Acl());
		
		// Adds custom action helper folders
		Zend_Controller_Action_HelperBroker::addPrefix('Artgroup_Controller_Action_Helper');

		// Настройка расширения view скриптов с помощью Action помошников 
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view)->setViewSuffix('phtml');
        
        // Return it, so that it can be stored by the bootstrap
        return $view;
    }
    /**
     * Управление доступом
     *
     * @return Объект Acl
     */
}