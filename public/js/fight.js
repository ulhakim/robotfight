    $(document).ready(function(){

        // change colour as pick robot
        $('.dynamic').change(function(){ 
        if($(this).val() != ''){
            var dependent = $(this).data('dependent');
            var id = $(this).data('id');
            // alert(id + ' >>> '+$(this).val());
            $.ajax({
                url: "fight/fetch?id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('.'+dependent).css('background', data.colour)
                    $('#'+id+'-avatar').text(data.id);
                    $('#'+id).val(data.id);
                }
            })
        }
        });

        $("#go").click(function() {
        var myro = $(this).data('myro');
        var opro = $(this).data('opro');
            $.ajax({
                url: "fight/whowin?myid=" + $('#'+myro).val() + "&&opid=" + $('#'+opro).val(),
                method: 'GET',
                error: function() { $('#winner').text("game fail");},
                success: function(data) {
                    $('#winner').text("The Winner is " + data.winner );
                }
            })
        });

    });