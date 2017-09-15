<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
<style type="text/css">
    .card {
        width: 400px;
        height: 200px;
        margin: auto;
    }
    .front, .other-front {
        border: 2px floralwhite solid;
        border-style: dashed;
        padding: 0 20px;
        padding-top: 10%;
        font-family: "Adobe Caslon Pro", "Hoefler Text", Georgia, Garamond, Times, serif;
        letter-spacing:0.1em;
        text-align: center;
        vertical-align: middle;
        font-size: 16pt;
        background-color: #70161E;
        color: floralwhite;
    }
    .back, .other-back {
        border: 2px #70161E solid;
        border-style: dashed;
        padding: 0 20px;
        padding-top: 10%;
        font-family: "Adobe Caslon Pro", "Hoefler Text", Georgia, Garamond, Times, serif;
        letter-spacing:0.1em;
        text-align: center;
        vertical-align: middle;
        font-size: 16pt;
        background-color: floralwhite;
        color: #70161E;
    }
    #navigation button{
        width: 200px;
        text-align: center;
    }
    #navigation div{
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div id="card" class="card">
    <div class="front" id="question">
        {FLIP_QUESTION}
    </div>
    <div class="back" id="answer">
        {FLIP_ANSWER}
    </div>
</div>
<hr>
<div id="navigation">
    <div class="next">
        <button class="btn btn-success" id="{FLIP_ID}" onclick="nextCard(this)">Start</button>
    </div>
    <div class="homepage">
        <a href="{SITE_URL}/wine">
            <button class="btn btn-default">Home Page</button>
        </a>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $("#card").flip({
            axis: "y",
            reverse: true,
            trigger: "click"
        });
    });
</script>
<script type="text/javascript">
    var siteurl = "{SITE_URL}";

    function nextCard(elem){
        var cardId = $(elem).attr('id');
        $.ajax({
            url : siteurl+"/wine/next",
            type : "POST",
            dataType: "Json",
            data : {cardId: cardId},
            success : function(response){
                console.log(response);
                $("#question").text(response['question']);
                $("#answer").text(response['answer']);
                $(".next button").attr('id', response['questionId']);
                $(".next button").html('Next card');
                if (response['questionId'] == 0) {
                    $(".next button").html('Start again');
                }
            }
        });
    }</script>