<html>
    <head>
        <title>Techgig Testsss</title>
        <script src="js/jquery.js"></script>
        <script>
            jQuery(document).ready(function(){
                function updatedata(){
                    var chosenvaluedata = '';
                    jQuery('#chosenwrap span').each(function(){
                        if(chosenvaluedata == ''){
                            chosenvaluedata = jQuery(this).data('childname');
                        }else{
                            chosenvaluedata = chosenvaluedata + ','+jQuery(this).data('childname');
                        }
                    });
                    jQuery('#chosenvaluesdata').val(chosenvaluedata);
                }
                //alert('test');
                jQuery('#parent').change(function(){
                    jQuery.post( "getchilds.php?id="+jQuery(this).val(), function( data ) {
                      jQuery('#childwrap').html( data );		  	
                    });
                });
                jQuery('#addbutton').click(function(){
                    var parentElement = document.getElementById("parent");
                    var parentText = parentElement.options[parentElement.selectedIndex].text;
                    var parentdivid = jQuery('.childvalues:nth-child(1)').attr('name');
                    if(jQuery('#'+parentdivid).length){
                        var selvals = '';
                        jQuery('input[name="'+parentdivid+'"]:checked').each(function() {
                           selvals = selvals + '<span data-childname="'+this.value+'">'+this.value+' <a href="#" class="removethis">X</a><br /></span>';
                        });
                        
                        var outstr = '<h5 class="parenttext">'+parentText+'</h5>'+selvals+'';
                        jQuery('#'+parentdivid).html(outstr);
                        
                    }else{
                        var selvals = '';
                        jQuery('input[name="'+parentdivid+'"]:checked').each(function() {
                           selvals = selvals + '<span data-childname="'+this.value+'">'+this.value+' <a href="#" class="removethis">X</a><br /></span>';
                        });
                        
                        var outstr = '<div id="'+parentdivid+'"><h5 class="parenttext">'+parentText+'</h5>'+selvals+'</div>';
                        jQuery('#chosenwrap').append(outstr);
                    }
                    jQuery('.removethis').bind('click',function(e){
                        e.preventDefault();
                        var childname = jQuery(this).parent('span').data('childname');
                        jQuery('input:checkbox[value="' + childname + '"]').attr('checked', false);
                        jQuery(this).parent('span').remove();
                        updatedata();
                    });		
                    updatedata();
                });
                
                
            });
        </script>
    </head>
    <body>
        <form method="post" action="thankyou.php">
            <select id="parent">
                <option value="">Select a Parent</option>
                <?php
                $con = mysql_connect('localhost', 'root', '');
                if (!$con)
                  {
                  die('Could not connect: ' .mysql_error());
                  }
                mysql_select_db('testdb', $con); 
                
                                            $query = "SELECT * from parent";
                        
                                            $result = mysql_query($query,$con);
                                            if (mysql_num_rows($result) > 0) { 
                                            while($row = mysql_fetch_array($result,MYSQLI_ASSOC)) {
                                                echo '<option value="'.$row['id'].'">'.$row['parentname'].'</option>';
                                            }}
                ?>
            </select>
            <div style="clear:both; height:10px;"></div>
            <div style="float:left; width:200px;border:1px solid #000; height:100px;" id="childwrap">
            </div>
            <div style="float:left; margin-left:10px;">
                <button type="button" id="addbutton">Add</button>
            </div>
            <div style="float:left; width:200px;border:1px solid #000; height:100px; margin-left:10px; overflow:scroll;" id="chosenwrap">
            </div>
            <div style="clear:both; height:10px;"></div>
            <input type="hidden" name="chosenvaluesdata" id="chosenvaluesdata" value="" />
            <input type="submit" value="Submit"/>
        </form>
    </body>
</html>