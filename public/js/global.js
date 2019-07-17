$(document).ready(function(){

    $(".select-advanced").select2({width: '100%', placeholder: "SELECCIONE UN ELEMENTO DE LA LISTA", allowClear: true});
	
	$("input[type=text], textarea").on("keyup", function () {
   		$input=$(this);
       	setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },1);
    });

	$("select[name=procedencia_id]").change(function () {
        $("select[name=procedencia_id] option:selected").each(function () {
            selected = $(this).val();
            if ( selected == 9999999999 ) {
            	$("#fileds_procedencia").show();
            	$("#fileds_procedencia>input").attr('disabled', false);
            	$("#lists_procedencia").hide();
            	$("#lists_procedencia>select").attr('disabled', true);
            }
        });
    });

    $("select[name=fk_presidente]").change(function () {
        $("select[name=fk_presidente] option:selected").each(function () {
            selected = $(this).val();
            if ( selected == 9999999999 ) {
                $("#fileds_presidente").show();
                $("#fileds_presidente>input").attr('disabled', false);
                $("#lists_presidente").hide();
                $("#lists_presidente>select").attr('disabled', true);
            }
        });
    });

    $("select[name=fk_secretario]").change(function () {
        $("select[name=fk_secretario] option:selected").each(function () {
            selected = $(this).val();
            if ( selected == 9999999999 ) {
                $("#fileds_secretario").show();
                $("#fileds_secretario>input").attr('disabled', false);
                $("#lists_secretario").hide();
                $("#lists_secretario>select").attr('disabled', true);
            }
        });
    });

    $("select[name=fk_vocal]").change(function () {
        $("select[name=fk_vocal] option:selected").each(function () {
            selected = $(this).val();
            if ( selected == 9999999999 ) {
                $("#fileds_vocal").show();
                $("#fileds_vocal>input").attr('disabled', false);
                $("#lists_vocal").hide();
                $("#lists_vocal>select").attr('disabled', true);
            }
        });
    });

    $("select[name=fk_suplente]").change(function () {
        $("select[name=fk_suplente] option:selected").each(function () {
            selected = $(this).val();
            if ( selected == 9999999999 ) {
                $("#fileds_suplente").show();
                $("#fileds_suplente>input").attr('disabled', false);
                $("#lists_suplente").hide();
                $("#lists_suplente>select").attr('disabled', true);
            }
        });
    });

    /*$("select.fieldset").change(function () {
        identify = $(this).attr('id');
        part = identify.split("_");
        id = part[1];
        $("select.fieldset option:selected").each(function () {
            selected = $(this).val();
            if ( selected == 9999999999 ) {
                $("#fileds_"+id).show();
                $("#fileds_"+id+">input").attr('disabled', false);
                $("#lists_"+id).hide();
                $("#lists_"+id+">select").attr('disabled', true);
            }
        });
    });*/

});/*END READY*/