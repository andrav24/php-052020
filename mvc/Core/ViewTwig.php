<?php


namespace Core;


class ViewTwig
{
    protected $_data;
    /** @var \Twig\Environment */
    private $_twig;

    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    public function __get($name)
    {
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }
        return '';
    }

    /**
     * @return \Twig\Environment
     */
    public function getTwig()
    {
        if (!$this->_twig) {
            $path = trim('../App/Views', DIRECTORY_SEPARATOR);
            $loader = new \Twig\Loader\FilesystemLoader($path);
            $this->_twig = new \Twig\Environment(
                $loader,
                ['cache' => $path . '_cache', 'autoescape' => false]
            );
        }

        return $this->_twig;
    }

    public function render(string $tpl)
    {
        $twig = $this->getTwig();

        ob_start();
        try {
            echo $twig->render($tpl, $this->_data + ['view' => $this, 'isAdmin' => $_SESSION['admin']]);
        } catch (\Exception $e) {
            trigger_error($e->getMessage());
        }
        return ob_get_clean();
    }
}