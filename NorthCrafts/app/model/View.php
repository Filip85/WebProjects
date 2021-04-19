<?php

class View {
    protected $layout = 'header';
    public function render($name, $args = []) {
        ob_start();
        extract($args);
        include BP . "app/view/$name.phtml";
        $content = ob_get_clean();
        echo $content;
        return $this;

        /*if ($this->layout) {
            include BP . "app/view/{$this->layout}.phtml";
        } else {
            echo $content;
        }*/  
    }
}