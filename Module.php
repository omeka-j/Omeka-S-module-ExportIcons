<?php

namespace ExportIcons;

use Omeka\Module\AbstractModule;
use Laminas\EventManager\SharedEventManagerInterface;
use Laminas\EventManager\Event;

//config
use Laminas\Mvc\Controller\AbstractController;
use Laminas\View\Renderer\PhpRenderer;
use ExportIcons\Form\ConfigForm;

use Laminas\ServiceManager\ServiceLocatorInterface;

class Module extends AbstractModule
{
    /** Module body **/

    /**
     * Get this module's configuration array.
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * getConfigForm
     *
     * 設定フォーム
     * @param  mixed $renderer
     */
    public function getConfigForm(PhpRenderer $renderer)
    {
        $translate = $renderer->plugin('translate');

        $services = $this->getServiceLocator();
        // 設定内容取得
        $settings = $services->get('Omeka\Settings');
        $form = $services->get('FormElementManager')->get(ConfigForm::class);

        // モジュール設定取得
        $config = $this->getConfig();
        // 設定値取得
        $defaultSettings = $config['ExportIcons']['config'];
        $data = [];
        foreach ($defaultSettings as $key => $v) {
            $data[$key] = $settings->get($key, '');
        }
        $form->init();
        // フォームにデータを設定する
        $form->setData($data);
        $html = $renderer->formCollection($form);
        return $html;
    }

    /**
     * handleConfigForm
     *
     * 設定フォーム送信時
     * @param  mixed $controller
     */
    public function handleConfigForm(AbstractController $controller)
    {
        $services = $this->getServiceLocator();
        $settings = $services->get('Omeka\Settings');
        $params = $controller->getRequest()->getPost();

        
        // モジュール設定取得
        $config = $this->getConfig();
        $defaultSettings = $config['ExportIcons']['config'];
        // 設定データ反映
        foreach ($defaultSettings as $key => $v) {
            echo "aaa";
            $settings->set($key, $params[$key]);
        }
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $controllers = [
            'Omeka\Controller\Site\Item'
        ];
        foreach ($controllers as $controller) {
            $sharedEventManager->attach(
                $controller,
                'view.show.after',
                [$this, 'displayModule']
            );
        }
    }

    /**
     * Display
     *
     * @param Event $event
     */
    public function displayModule(Event $event)
    {
        $view = $event->getTarget();
        $resource = $event->getTarget()->resource;
        echo $view->ExportIcons($resource);
    }

    /**
     * install
     * インストールで実行する処理
     *
     * @param ServiceLocatorInterface $services
     */
    public function install(ServiceLocatorInterface $services): void
    {
        $translator = $services->get('MvcTranslator');
        // サービスをメンバー変数に設定する
        $this->setServiceLocator($services);
        // 後処理を実行する
        $this->postInstall($services);
    }

    /**
     * postInstall
     *
     * インストール後処理
     * @param  mixed $services
     */
    protected function postInstall(ServiceLocatorInterface $services): void
    {
        // 設定追加
        $this->manageSetting('install');
    }

    /**
     * unistall
     * アンインストールで実行する処理
     *
     * @param ServiceLocatorInterface $services
     */
    public function uninstall(ServiceLocatorInterface $services): void
    {
        // 設定を削除する
        $this->manageSetting('unistall');
    }
    /**
     * manageSetting
     *
     * 設定を追加、削除する
     * @param [type] $type
     */
    private function manageSetting($type): void
    {
        // サービス取得
        $services = $this->getServiceLocator();
        $settings = $services->get('Omeka\Settings');
        // モジュール設定取得
        $config = $this->getConfig();
        // 設定値取得
        $defaultSettings = $config['ExportIcons']['config'];
        switch ($type) {
            // インストール時の追加処理
            case 'install':

                // 初期データ登録
                foreach ($defaultSettings as $key => $v) {
                    $settings->set($key, $v);
                }
                break;
            case 'unistall':
                // 設定削除
                foreach ($defaultSettings as $key => $v) {
                    $settings->delete($key);
                }
                break;
        }
    }
}
