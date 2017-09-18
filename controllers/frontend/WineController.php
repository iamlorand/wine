<?php

$wineView = new Wine_View($tpl);
$wineModel = new Wine();
$session = Zend_Registry::get('session');

// all actions MUST set  the variable  $pageTitle
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

switch ($registry->requestAction)
{
    default:
//    case 'list':
//        $wineList = $wineModel->getWineQuestions();
//        $wineView->showWineQuestions('wine_list', $wineList);
//        break;

    case 'quiz':
        $quizQuestion['question'] = 'Click Start to start the quiz!';
        $quizQuestion['id'] = 0;

        $wineView->showWineQuizQuestions('wine_quiz', $quizQuestion);
        break;

    case 'list':
        if ($_POST['questionId'] == 0) {
            $quizQuestion = $wineModel->getWineQuestions('1');
            $quizAnswerList = $wineModel->getAllAnswersByQuestionId($quizQuestion['id']);

            $responseAnswers = [];
            for ($i = 0; $i < count($quizAnswerList); $i++) {
                $responseAnswers[$i]['id'] = $quizAnswerList[$i]['id'];
                $responseAnswers[$i]['answer'] = $quizAnswerList[$i]['answer'];
            }

            $questionIdList = $wineModel->getWineQuestionIds();
            foreach ($questionIdList as $id) {
                $questionIdList['id'][] = $id['id'];
            }
            shuffle($questionIdList['id']);
            $session->questionIdList['questionIdList'] = $questionIdList['id'];

            $response = [
                "success" => "true",
                "questionId" => $quizQuestion['id'],
                "question" => $quizQuestion['question'],
                "answer" => $responseAnswers
            ];

            echo Zend_Json::encode($response);
            exit();
        }   else {
            $questionId = $_POST['questionId'];
            if (count($session->questionIdList['questionIdList']) > 1) {

                if(($key = array_search($questionId, $session->questionIdList['questionIdList'])) !== false) {
                    unset($session->questionIdList['questionIdList'][$key]);
                }

                $randKey = array_rand($session->questionIdList['questionIdList'], 1);
                $rand = $session->questionIdList['questionIdList'][$randKey];
                $quizQuestion = $wineModel->getNextRandomQuestionById($rand);
                $quizAnswerList = $wineModel->getAllAnswersByQuestionId($quizQuestion['id']);

                $responseAnswers = [];
                for ($i = 0; $i < count($quizAnswerList); $i++) {
                    $responseAnswers[$i]['id'] = $quizAnswerList[$i]['id'];
                    $responseAnswers[$i]['answer'] = $quizAnswerList[$i]['answer'];
                }
            } else {
                if(($key = array_search($questionId, $session->questionIdList['questionIdList'])) !== false) {
                    unset($session->questionIdList['questionIdList'][$key]);
                }
                $quizQuestion['question'] = 'No more questions!';
                $quizQuestion['id'] = 0;
                $responseAnswers = [];
            }

            if ($_POST['answerId'] != NULL) {
                $userAnswer = $_POST['answerId'];
                $rightAnswer = $wineModel->getCorrectAnswerByQuestionId($questionId);
                if ($userAnswer == $rightAnswer['id']) {
                    //TODO plus 1pt;
                } else {
                    //TODO minus 1pt;
                }
            }

            $response = [
                "success" => "true",
                "questionId" => $quizQuestion['id'],
                "question" => $quizQuestion['question'],
                "answer" => $responseAnswers
            ];

            echo Zend_Json::encode($response);
            exit();
        }
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
            $flipAnswer = $wineModel->getCorrectAnswerByQuestionId($flipQuestion['id']);

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
            $cardId = $_POST['cardId'];
            if (count($session->questionIdList['questionIdList']) > 1) {
                if(($key = array_search($cardId, $session->questionIdList['questionIdList'])) !== false) {
                    unset($session->questionIdList['questionIdList'][$key]);
                }
                $randKey = array_rand($session->questionIdList['questionIdList'], 1);
                $rand = $session->questionIdList['questionIdList'][$randKey];
                $flipQuestion = $wineModel->getNextRandomQuestionById($rand);
                $flipAnswer = $wineModel->getCorrectAnswerByQuestionId($flipQuestion['id']);
            } else {
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