<?php

class Wine extends Dot_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /** Returns all questions from the table question
     *
     * return array $result
     */
    public function getWineQuestions($limit = '') {
        if ($limit == 1) {
            $select = $this->db->select()
                                ->from('wineQuestion')
                                ->order('rand()')
                                ->limit($limit);
            $result = $this->db->fetchRow($select);
            return $result;
        } else {
            $select = $this->db->select()
                                ->from('wineQuestion')
                                ->order('rand()')
                                ->limit($limit);
            $result = $this->db->fetchAll($select);
            return $result;
        }
    }
    /** Returns all questions from the table question
     *
     * return array $result
     */
    public function getWineAnswerByQuestionId($questionId) {
        $select = $this->db->select()
                            ->from('wineAnswer')
                            ->where('questionId=?', $questionId)
                            ->where('solution=1');
        $result = $this->db->fetchRow($select);
        return $result;
    }
    /** Returns questionIds from the table question
     *
     * return array $result
     */
    public function getWineQuestionIds() {
        $result = $this->db->fetchAll('SELECT id FROM wineQuestion');
        return $result;
    }
    /** Returns a question from the table question by id
     *
     * return array $result
     */
    public function getNextRandomQuestionById($rand) {
        $select = $this->db->select()
                            ->from('wineQuestion')
                            ->where('id=?', $rand);
        $result = $this->db->fetchRow($select);
        return $result;
    }
}