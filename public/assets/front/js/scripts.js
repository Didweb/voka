/*!
* Start Bootstrap - Personal v1.0.1 (https://startbootstrap.com/template-overviews/personal)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-personal/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project
function nextWord(goalJson, path) {

    $.ajax({
        url: path,
        method: 'POST',
        data: {
            goal: goalJson
        },
        success: function(data) {
            $('#next').html(data);
        }

    })

}

function toTraining(goalJson, path) {

    $.ajax({
        url: path,
        method: 'POST',
        data: {
            goalJson: goalJson
        },
        success: function(data) {
            $('#next').html(data);
        }

    })

}

function startAgainQuiz(goalJson, path) {

    $.ajax({
        url: path,
        method: 'POST',
        data: {
            goalJson: goalJson
        },
        success: function(data) {
            $('#next').html(data);
        }

    })

}


function nextWordQuiz(goalJson, path) {

    $.ajax({
        url: path,
        method: 'POST',
        data: {
            goal: goalJson
        },
        success: function(data) {
            $('#next').html(data);
        }

    })

}




function startQuiz(goalJson, path) {

    $.ajax({
        url: path,
        method: 'POST',
        data: {
            goalJson: goalJson
        },
        success: function(data) {
            $('#next').html(data);
        }

    })
}


function onClickSetUp(value) {
    $('#setup_destination').val(value);
}

$('.optionsQuiz').on('click', function(){

    let dataGoal = $('#dataGoal');
    let goalJson = dataGoal.data('goal');
    let path =  dataGoal.data('path');
    let option =  $(this).data('option');
    let wordPosition =  $(this).data('wordposition');

    $.ajax({
        url: path,
        method: 'POST',
        data: {
            goalJson: goalJson,
            option: option,
            wordPosition: wordPosition
        },
        success: function(data) {
            $('#resultOptionQuiz').html(data);
        }

    })
});