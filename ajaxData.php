<script>
$(document).ready(function(){
    $('#location').on('change', function(){
        var locationName = $(this).val();
        if(locationName){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'locationName='+locationName,
                success:function(html){
                    $('#location').html(html);
                    $('#hotel').html('<option value="">Select location first</option>'); 
                }
            }); 
        }else{
            $('#hotel').html('<option value="">Select location first</option>');
        }
    });
    
    // $('#state').on('change', function(){
    //     var stateID = $(this).val();
    //     if(stateID){
    //         $.ajax({
    //             type:'POST',
    //             url:'ajaxData.php',
    //             data:'state_id='+stateID,
    //             success:function(html){
    //                 $('#city').html(html);
    //             }
    //         }); 
    //     }else{
    //         $('#city').html('<option value="">Select state first</option>'); 
    //     }
    // });
});


</script>