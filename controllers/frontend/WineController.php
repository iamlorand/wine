<?php

$wineView = new Wine_View($tpl);
$wineModel = new Wine();
$session = Zend_Registry::get('session');

// all actions MUST set  the variable  $pageTitle
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

switch ($registry->requestAction)
{
    default:
    case 'list':
        $wineList = $wineModel->getWineQuestions();
        $wineView->showWineQuestions('wine_list', $wineList);
        break;

    case 'flip':
        $flipQuestion['question'] = 'Click next card to start!';
        $flipQuestion['id'] = 0;
        $flipAnswer['answer'] = 'Click next card to start!';

        $wineView->showFlipQuestion('flip', $flipQuestion, $flipAnswer);
        break;

    case 'next':
        if ($_POST['cardId'] == 0) {
            $flipQuestion = $wineModel->getWineQuestions('1');
            $flipAnswer = $wineModel->getWineAnswerByQuestionId($flipQuestion['id']);

            $questionIdList = $wineModel->getWineQuestionIds();
            foreach ($questionIdList as $id) {
                $questionIdList['id'][] = $id['id'];
            }
            shuffle($questionIdList['id']);
            $session->questionIdList['questionIdList'] = $questionIdList['id'];

            $response = [
                "success" => "true",
                "questionId" => $flipQuestion['id'],
                "question" => $flipQuestion['question'],
                "answer" => $flipAnswer['answer']
            ];

            echo Zend_Json::encode($response);
            exit();
        } else {
            if (count($session->questionIdList['questionIdList']) > 1) {
                $cardId = $_POST['cardId'];
                if(($key = array_search($cardId, $session->questionIdList['questionIdList'])) !== false) {
                    unset($session->questionIdList['questionIdList'][$key]);
                }
                $randKey = array_rand($session->questionIdList['questionIdList'], 1);
                $rand = $session->questionIdList['questionIdList'][$randKey];
                $flipQuestion = $wineModel->getNextRandomQuestionById($rand);
                $flipAnswer = $wineModel->getWineAnswerByQuestionId($flipQuestion['id']);
            } else {
                $cardId = $_POST['cardId'];
                if(($key = array_search($cardId, $session->questionIdList['questionIdList'])) !== false) {
                    unset($session->questionIdList['questionIdList'][$key]);
                }
                $flipQuestion['question'] = 'No more questions!';
                $flipQuestion['id'] = 0;
                $flipAnswer['answer'] = 'No more questions!';
            }

            $response = [
                "success" => "true",
                "questionId" => $flipQuestion['id'],
                "question" => $flipQuestion['question'],
                "answer" => $flipAnswer['answer']
            ];

            echo Zend_Json::encode($response);
            exit();
        }
        break;
}