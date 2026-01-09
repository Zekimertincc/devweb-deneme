<?php

class VueFooter
{
    private $footer;

    public function prepareFooter()
    {
        $this->footer = '<footer class="footer">MVC3</footer>';
    }

    public function renderFooter()
    {
        echo $this->footer;
    }

}