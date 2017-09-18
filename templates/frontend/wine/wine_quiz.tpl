<div class="container">
    <h3 id="question">{QUESTION_QUESTION}</h3>
    <hr>
    <div>
        <input id="answer0" type="radio" name="answer" value=""><label for="answer0" style="margin-left: 2px;">A</label><br>
    </div>
    <div>
        <input id="answer1" type="radio" name="answer" value=""><label for="answer1" style="margin-left: 2px;">B</label><br>
    </div>
    <div>
        <input id="answer2" type="radio" name="answer" value=""><label for="answer2" style="margin-left: 2px;">C</label><br>
    </div>
    <div>
        <input id="answer3" type="radio" name="answer" value=""><label for="answer3" style="margin-left: 2px;">D</label><br>
    </div>
    <hr>
    <div class="next">
        <button class="btn btn-success" name="next" id="0" onclick="nextQuestion(this)">Start quiz</button>
    </div>
</div>

<script type="text/javascript">
    var siteurl = "{SITE_URL}";
    var answerId = null;
    $("input:radio[name=answer]").click(function() {
        $(this).prop('checked', true);
        answerId = $(this).val();
    });

    function nextQuestion(elem){
        var questionId = $(elem).attr('id');

        $.ajax({
            url : siteurl+"/wine/list",
            type : "POST",
            dataType: "Json",
            data : {answerId: answerId, questionId: questionId},
            success : function(response){
                $( "input:checked" ).prop('checked', false);
                $("#question").text(response['question']);

                for(i = 0; i < response['answer'].length; i++) {
                    $("#answer"+i).val(response['answer'][i]['id']);
                    $("label[for=answer"+i+"]").html(response['answer'][i]['answer']);
                }
                $(".next button").attr('id', response['questionId']);
                $(".next button").html('Next question');
                if (response['questionId'] == 0) {
                    $(".next button").html('Start again');
                    for(i = 0; i < 4; i++) {
                        $("#answer"+i).val('0');
                        $("label[for=answer"+i+"]").parent().hide();
                    }
                }
            }
        });
    }
</script>