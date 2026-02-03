<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deneme Sınavı Demo Sayfası</title>
    <!-- add bootstrap 5 --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #exam-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .question {
            margin-bottom: 20px;
            text-align: center;
        }
        .options {
            display: flex;
            justify-content: space-around;
        }
        .option {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    

    <div id="exam-container">

    <div class="question"></div>

    <div class="options">

        <button class="option" data-option="A">A</button>
        <button class="option" data-option="B">B</button>
        <button class="option" data-option="C">C</button>
        <button class="option" data-option="D">D</button>

    </div>

    <div style="text-align: center; margin-top: 20px;">
        <button id="prev-question-btn">Önceki Soru</button>
        <button id="next-question-btn">Sonraki Soru</button>
    </div>


    <div style="text-align: right; margin-top: 20px;">
        <button id="submit-exam-btn">Sınavı Bitir</button>
    </div>

    <div class="answers">
        <p id="answers-display"></p>
    </div>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // jquery
    
    $(document).ready(function() {
        const studentId = '{{ auth("student")->user()->id; }}';
        let questions = @json(
            $examQuestions->get()->map(function ($q) {
                return [
                    'id' => $q->id,
                    'questionImg' => $q->question_image
                ];
            })->toArray()
        );


        let answers = new Array(questions.length).fill(null);

        let currentQuestionIndex = 0;


        function loadQuestion(index) {
            const question = questions[index];
            $('.question').html('<img src="{{asset("assets/img/exam_questions")}}/' + question.questionImg + '" alt="Question Image" style="max-width: 100%;">');
        }

        $('.option').click(function() {

            // if option already selected, deselect it
            if ($(this).hasClass('selected')) {
                console.log('deselected');
                $(this).removeClass('selected');
                answers[currentQuestionIndex] = null;
                console.log(answers);
                colorAnswerButtons()
                return;
            }else{
                $('.option').removeClass('selected');
                $(this).addClass('selected');

                const selectedOption = $(this).data('option');
                const questionId = questions[currentQuestionIndex].id;
                answers[currentQuestionIndex] = [questionId, selectedOption];
                console.log(answers);
                colorAnswerButtons()
            }
            
        });

        $('#next-question-btn').click(function() {
            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                loadQuestion(currentQuestionIndex);
            }

            if(currentQuestionIndex === questions.length -1){
                $('#next-question-btn').hide();
            }
            $('.option').removeClass('selected');
            colorAnswerButtons();
            showAnswers();
        });

        $('#prev-question-btn').click(function() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                loadQuestion(currentQuestionIndex);
            }
            $('.option').removeClass('selected');
            $('#next-question-btn').show();
            colorAnswerButtons();
            showAnswers();
        });

        function colorAnswerButtons() {
            $('.option').each(function() {
                const option = $(this).data('option');
                if (answers[currentQuestionIndex] && answers[currentQuestionIndex][1] === option) {
                    $(this).css('background-color', 'lightgreen');
                } else {
                    $(this).css('background-color', '');
                }
            });
        }

        function showAnswers() {
            // stringify answers and send to server or display
            const answersString = JSON.stringify(answers);
            $('#answers-display').text('Cevaplar: ' + answersString);
        };


        $('#submit-exam-btn').click(function() {

            //convert answers to json and show in alert
            const answersString = JSON.stringify(answers);
            // send answers to server via ajax
            $.ajax({
                url: '/exam/{{ $exam->id }}/submit-answers',
                method: 'POST',
                data: {
                    student_id: studentId,
                    answers: answersString,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Sınav başarıyla gönderildi!');
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    alert('Sınav gönderilirken bir hata oluştu.');
                    console.log(error);
                }
            });
        });

        loadQuestion(currentQuestionIndex);
    });






</script>
</body>
</html>