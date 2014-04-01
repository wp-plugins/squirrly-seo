<?php

/**
 * Account settings
 */
class SQ_BlockAccount extends SQ_BlockController {

    public function action() {
        parent::action();
        switch (SQ_Tools::getValue('action')) {
            case 'sq_hide_survey':
                SQ_Tools::saveOptions('sq_hide_survey', (int) SQ_Tools::getValue('sq_hide_survey'));
                exit();
                break;
        }
    }

}
