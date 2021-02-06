<style>
    .yellow {
        color: #e6e600;
    }

    .label_evaluation {
        font-size: 25px;
    }

</style>
<script>

    $("#rating_evaluation .label_evaluation").fadeIn(500);
    showStars($("#rating_evaluation .label_evaluation"));

    $("#rating_evaluation .label_evaluation .rating").click(function () {
        let value = parseInt($(this).attr("data-value")) + 1;
        updateStar(value);
    });

    function updateStar(value) {
        var ratings = $("#rating_evaluation .label_evaluation").find(".rating");
        for (let i = 0; i < ratings.length; i++) {
            let span = $(ratings[i]);
            console.log(span);
            span.removeClass("fa-star fa-star-o yellow");
            if (i < value) {
                span.addClass("fa-star yellow");
            } else {
                span.addClass("fa-star-o");
            }
        }
        $("#rating_evaluation input").val(value)
    }


    function showStars(element) {
        let evaluation = parseInt($(element).text());
        $(element).text("");
        $(element).html("");
        for (let i = 0; i < 5; i++) {
            let classStyle = i < evaluation ? "fa-star yellow" : "fa-star-o";
            $(element).html($(element).html() + "<span data-value='" + i + "' class='rating fa " + classStyle + "'></span>")
        }

    }
</script>
