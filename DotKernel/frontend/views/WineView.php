<?php

class Wine_View extends View
{
    public function __construct($tpl)
    {
        $this->tpl = $tpl;
        $this->settings = Zend_Registry::get('settings');
        $this->session = Zend_Registry::get('session');
    }

    /** Sends all questions from the $questionList to the browser
     * @param string $template
     * @param array $questionList
     */
    public function showWineQuestions($template = '', $questionList)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'wine/' . $this->template . '.tpl');
            $this->tpl->setBlock('tpl_main', 'wine_list', 'wine_list_block');
            foreach ($questionList as $question) {
                foreach ($question as $key => $value) {
                    $this->tpl->setVar('WINE_'.strtoupper($key), $value);
                }
                $this->tpl->parse('wine_list_block', 'wine_list', TRUE);
            }
        }
    }

    /** Sends the $question and the $answer to the browser
     * @param string $template
     * @param array $question
     * @param array $answer
     */
    public function showFlipQuestion($template = '', $question, $answer)
    {
        if (!empty($template))
        {
            $this->template = $template;
            $this->tpl->setFile('tpl_main', 'wine/' . $this->template . '.tpl');
            $this->tpl->setVar('FLIP_ID', $question['id']);
            $this->tpl->setVar('FLIP_QUESTION', $question['question']);
            $this->tpl->setVar('FLIP_ANSWER', $answer['answer']);
        }
    }
}