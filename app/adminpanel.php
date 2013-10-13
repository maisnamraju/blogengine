<?php
    include_once("../engine/database.php");
    //include_once("../engine/engine.php");
    if (isset($_POST["name"],$_POST["password"]) ) {      
      $uname  = htmlspecialchars(mysql_real_escape_string($_POST["name"]) );
      $passwd = htmlspecialchars(mysql_real_escape_string($_POST["password"]) );
      $query = "SELECT * FROM users WHERE username ='".$uname."' AND password='".$passwd."' LIMIT 1";
      $query= mysql_query($query);
      if(mysql_num_rows($query) == 1) {
        session_start();
        $_SESSION['admin'] = "Welcome to the Admin Panel {$_POST['name']} ";
        $_SESSION['onOff'] = 'on';
?>        
     <!DOCTYPE html>
      <html>
      <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
          <script type="text/javascript" src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script> 
          <script>
          tinymce.init({
              selector: "textarea#postCont",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });          
           </script>
         <script>     
              function editPost(rowNo) {   //editing a post 
                xhr = new ajaxValue();
                this.rowValue = parseInt(rowNo);    // rowValue works may need to change it back
                xhr.onreadystatechange = function() {                                              
                                           if(this.readyState === 4 ) {
                                                if (this.status === 200) {   
                                                        

                                                    return false;                                                                                                     
                                                 }
                                             }                 
                                            else {
                                                return false;
                                              /*alert("Loading...");                                              
                                              alert("status " + this.status);
                                              alert("readyState " + this.readyState); */
                                            }                                                
                                        }  
                var data = "rowNo=" + rowValue. "&edit=" + 1;                            
                var url = '../engine/engine.php';
                xhr.open('POST', url , true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");   
                xhr.send(data);
                return false;
                                         
              }          
              function deletePost(rowNo) {
                xhr = new ajaxValue();
                this.rowValue = parseInt(rowNo);
                //alert(rowNo);
                xhr.onreadystatechange = function() {                                              
                                           if(this.readyState === 4 ) {
                                                if (this.status === 200) {                                                                                                            
                                                   //removes all content from page
                                                   var curNode = document.getElementById(rowValue);     
                                                   curNode.parentNode.removeChild(curNode);
                                                   alert(this.responseText);
                                                   return false;                                                                                                     
                                                 }
                                             }                 
                                            else {
                                                return false;
                                              /*alert("Loading...");                                              
                                              alert("status " + this.status);
                                              alert("readyState " + this.readyState); */
                                            }                                                
                                        }  
                var data = "rowNo=" + rowValue;                            
                var url = '../engine/engine.php';
                xhr.open('POST', url , true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");   
                xhr.send(data);
                return false;
              }      

              function submitArticle() {  
               tinyMCE.triggerSave();                                                                                                  
               var postTitle = document.getElementById('postTitle').value;
               var postDes   = document.getElementById('postDes').value;
               var postCont  = document.getElementById('postCont').value;                  
               xhr = new ajaxValue();  
               //alert(postCont);
               var data = "postTitle=" + postTitle + "&postDes=" + postDes + "&postCont=" + postCont;                            
               var url = '../engine/engine.php';
               xhr.open('POST', url , true);
               xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");   
               xhr.send(data);                
               xhr.onreadystatechange = function() {
                                           if(this.readyState === 4 ) {
                                                    if (this.status ===200) {                     
                                                             // var hidden = document.getElementById('wrapper'); 
                                                             // hidden.removeAttribute('hidden');
                                                             //var popUp = document.getElementById('popup');
                                                             //popUp.innerHTML= this.responseText;
                                                            document.getElementById('postTitle').value = " ";     /* removes all content from page */
                                                            document.getElementById('postDes').value   = " ";                                                                                                                        
                                                            tinyMCE.activeEditor.setContent('');
                                                            
                                                              }
                                             }                 
                                            else {
                                              return false
                                                //alert("Loading...");                                              
                                              //alert("status " + this.status);
                                              //alert("readyState " + this.readyState);
                                                  }                                                
                                        }           
               return false;                                                                                                                                                                                                                                         
              }

                             function ajaxValue() {
                    try {
                         xhr = new XMLHttpRequest();                         
                      }
                      catch(e) {
                                try {
                                  var  xhr = new ActiveXObject("Microsoft.XMLHTTP");
                                }
                        catch(e) {
                                    try {
                                       var  xhr = new ActiveXObject("Msxml2.XMLHTTP");
                                    }
                                    catch(e) {
                                      alert("Your Browser is not Supported");
                                      
                                    }
                        }                          
                      }
                      return xhr;
                 }    
           </script>
           <style>
                #wrapper {
                  position: absolute;
                  opacity: 0.9;
                  height: 100%;
                  width: 100%;                  
                  background-color: #2C3131;
                  z-index: 1;                 
                }  
                #popup {
                  height:10em;
                  width:31.250em;
                  background:#F0F0F0;
                  position:absolute;
                  margin:0 auto;
                  z-index: 99999999;
                }
                #scroll {
                  height:300px;
                  overflow:scroll;
                }
           </style>
          <title>Admin Panel</title>     
      </head>
      <body>    
        <div id="wrapper" hidden="hidden"></div>
      <!--  <div id="popup"></div> -->
        <div class="pure-g-r" style="letter-spacing:0em; padding-left:2em; padding-right:2em;">   
           <div class="pure-u-5-10">                                
              <form class="pure-form pure-form-stacked" method='post'>
                <fieldset>         
                  <legend><?php echo  $_SESSION['admin']; ?></legend>
                  <div style="margin:0 auto;">                      
                      <input id='postTitle' type='text' name='postTitle' class="pure-input-1" placeholder='Article Title'/>                                
                  </div>
                  <textarea  id='postDes' class="pure-input-1" name='postDes' name='postDes' cols='102' placeholder='Article Summary'></textarea>                  
                  <textarea  id="postCont" name='postCont' cols='60' rows='10'></textarea>                  
                  <br />
                  <button  id='submit' onclick='return submitArticle()' class="pure-button pure-input-1 pure-button-primary">Submit</button>                  
                </fieldset>                
              </form>
          </div>          
          <div class="pure-u-4-10"> 
               <div id="scroll">
                    <h2 style="margin:0 auto;">Posted articles</h2>
                  <?php 
                           $fetchQuery = "SELECT * FROM blogposts ORDER BY blogid DESC LIMIT 0 , 30";
                           $result = mysql_query($fetchQuery) or die(mysql_error());
                           //echo $result;
                           while ($row = mysql_fetch_assoc($result)) {
                        ?> 
                  <dl id="<?php echo $row["blogid"]; ?>">  
                      <dt><?php echo $row["title"]; ?></dt>
                      <dd><a href=""><small><a href="javascript:editPost(<?php echo $row["blogid"] ?>);">Edit</a></small> | <small><a href="javascript:deletePost(<?php echo $row["blogid"] ?>);"> Delete</a></small></a>                      
                  </dl>    
                  <?php 
                    }
                  mysql_free_result($result);
                  ?>  
               </div>                              
        </div>                  
        </div>                 
      </body>      
    </html>         
<?php   }
      else {
          echo "username or password is incorrect";
          //header('Location: /login.php');
          die(mysql_error());

      }
    }  
    
?>
