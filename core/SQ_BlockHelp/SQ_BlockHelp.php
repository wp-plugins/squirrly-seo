<?php

/**
 * Affiliate settings
 */
class SQ_BlockHelp extends SQ_BlockController {

    public function action() {
        parent::action();
        switch (SQ_Tools::getValue('action')) {
            case 'sq_howto':
                SQ_Tools::saveOptions('sq_howto', (int) SQ_Tools::getValue('sq_howto'));
                exit();
                break;
        }
    }

    public function hookGetContent() {
        $this->options = SQ_Tools::$options;
    }

}
