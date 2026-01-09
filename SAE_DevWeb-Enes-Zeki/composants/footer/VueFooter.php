<?php

class VueFooter
{
    private $footer;

    public function prepareFooter()
    {
        $this->footer = '<div class="text-center text-muted small">MVC3 • E-BUVETTE</div>';
    }

    public function renderFooter()
    {
        echo $this->footer;
    }

}
