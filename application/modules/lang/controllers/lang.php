<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lang extends MX_Controller {

    public function __construct() {
        parent::__construct();
        /* Если не выбран язык, то ставим язык по-умолчанию,
         * переадресовывая пользователя на правильный URL
         */
        $this->_check_lang();
    }

}
