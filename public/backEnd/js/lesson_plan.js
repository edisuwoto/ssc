// get lessson for topic
$(document).ready(function() {
    $(".select_subject").on("change", function() {

        var url = $("#url").val();
        var i = 0;
        var select_subject = $("#select_subject").val();
        var select_section = $("#select_section").val();
        var i = 0;

        var formData = {
            class: $("#select_class").val(),
            subject: $("#select_subject").val(),
            section: $("#select_section").val(),
        };

        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/lesson/" + "ajaxSelectLesson",

            beforeSend: function() {
                $('#select_lesson_loader').addClass('pre_loader');
                $('#select_lesson_loader').removeClass('loader');
            },

            success: function(data) {

                $.each(data, function(i, item) {
                    if (item.length) {
                        $("#select_lesson").find("option").not(":first").remove();
                        $("#select_lesson_div ul").find("li").not(":first").remove();

                        $.each(item, function(i, lesson) {
                            $("#select_lesson").append(
                                $("<option>", {
                                    value: lesson.id,
                                    text: lesson.lesson_title,
                                })
                            );

                            $("#select_lesson_div ul").append(
                                "<li data-value='" +
                                lesson.id +
                                "' class='option'>" +
                                lesson.lesson_title +
                                "</li>"
                            );
                        });


                    } else {
                        $("#select_lesson_div .current").html("SELECT lesson *");
                        $("#select_lesson").find("option").not(":first").remove();
                        $("#select_lesson_div ul").find("li").not(":first").remove();
                    }
                });
            },
            error: function(data) {
                console.log("Error:", data);
            },
            complete: function() {
                i--;
                if (i <= 0) {
                    $('#select_lesson_loader').removeClass('pre_loader');
                    $('#select_lesson_loader').addClass('loader');
                }
            }
        });
    });
});
// get topic from lesson
$(document).ready(function() {
    $(".select_lesson").on("change", function() {


        var url = $("#url").val();
        var lesson_id = $("#select_lesson").val();


        var formData = {
            lesson_id: lesson_id,
            class_id: $("#class_id").val(),
            subject_id: $("#subject_id").val(),
            section_id: $("#section_id").val()
        };
        console.log(formData);
        console.log(select_section);
        // get lesson from subhect,class,seciton
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/lesson/" + "ajaxSelectTopic",

            success: function(data) {
                $.each(data, function(i, item) {
                    if (item.length) {
                        $("#select_topic").find("option").not(":first").remove();
                        $("#select_topic_div ul").find("li").not(":first").remove();

                        $.each(item, function(i, topic) {
                            $("#select_topic").append(
                                $("<option>", {
                                    value: topic.id,
                                    text: topic.topic_title,
                                })
                            );

                            $("#select_topic_div ul").append(
                                "<li data-value='" +
                                topic.id +
                                "' class='option'>" +
                                topic.topic_title +
                                "</li>"
                            );
                        });
                    } else {
                        $("#select_topic_div .current").html("SELECT topic *");
                        $("#select_topic").find("option").not(":first").remove();
                        $("#select_topic_div ul").find("li").not(":first").remove();
                    }
                });
            },
            error: function(data) {
                console.log("Error:", data);
            },
        });
    });
});

changeLesson = () => {
    var url = $("#url").val();

    var formData = {
        class_id: $('#class_id').val(),
        section_id: $('#section_id').val(),
        subject_id: $('#subject_id').val(),
        lesson_id: $('#select_lesson').val(),
    };
    // console.log(formData);
    $.ajax({
        type: "GET",
        data: formData,
        dataType: "json",
        url: url + '/lesson/' + 'ajaxSelectTopic',

        beforeSend: function() {
            $('#select_topic_loader').addClass('pre_loader');
            $('#select_topic_loader').removeClass('loader');
        },


        success: function(data) {
            // console.log(data);
            $.each(data, function(i, item) {
                if (item.length) {
                    $("#select_topic").find("option").not(":first").remove();
                    $("#select_topic_div ul").find("li").not(":first").remove();

                    $.each(item, function(i, topic) {
                        $("#select_topic").append(
                            $("<option>", {
                                value: topic.id,
                                text: topic.topic_title,
                            })
                        );

                        $("#select_topic_div ul").append(
                            "<li data-value='" +
                            topic.id +
                            "' class='option'>" +
                            topic.topic_title +
                            "</li>"
                        );
                    });
                    $('#select_topic_loader').removeClass('pre_loader');
                    $('#select_topic_loader').addClass('loader');
                } else {
                    $("#select_topic_div .current").html("SELECT topic *");
                    $("#select_topic").find("option").not(":first").remove();
                    $("#select_topic_div ul").find("li").not(":first").remove();
                }
            });
        },
        error: function(data) {
            // console.log("Error:", data);
        },
    });
};