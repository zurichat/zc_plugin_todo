<template>
     <div>
        
        <div class="nav ">
                     <select name="pets" id="sel">
                         <option value=""># <span>Todo-list</span></option>
                         <option value="">cook</option>
                         <option value="">fish</option>
                         <option value="">Hamster</option>
                         <option value="">Parrot</option>
                         <option value="">Spider</option>
                         <option value="">Goldfish</option>  
                     </select>
         </div>
         <div class="secondnav">
             <div class="topnav flex space-between">
                     <div class="first">
                         <a class="active" href="#home">pending</a>
                         <a href="#news">archive</a>
                         <a href="#contact">trash</a>
                     </div>
                 
                     <div class="second">
                         <button class="bu" id="myBtn">
                             create a new task
                         </button>
                    </div>
             </div>
          </div>
          </div>

          <div class="empty ">
              <i class=""></i>
              <img src="img/Group.png">
              <p class="al">You have no To-dos yet. Click on the button below to <br>add your first one. 
                  To-do list created will appear here.</p>
              <button class="ot" id="myBtn">+ create a new todo</button>
          </div>
          <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content ">
              <div class="heading">
                <span class="close">&times;</span>
                  <h1>create a new task</h1>
                 
              </div>
              <div class="bodyy">
                  <p class="p-two">Todos help you keep track of tasks. They are best 
                      when created specifically for a task with subsequent sub tasks
                  </p>
              </div>
              <div class="form">
                  <form action="/action_page.php">
                      <label for="fname"> Name</label>
                      <input  class="in" type="text" id="fname" name="firstname" placeholder="e.g Todo 01">
                  
                      <label for="lname" class="formspace">Description (optional)</label>
                      <input class="in" type="text" id="lname" name="lastname" placeholder="Design the UI for a todo plugin">
                       
                     
                       
                      <label for="lname" class="formspace">Due data (optional)</label>
                      <select class="in" id="country" name="country">
                          <option value="australia"><img src="img/active.png"></option>
                          <option value="canada">Alex</option>
                          <option value="usa">jordan</option>
                        </select>
                      
                     
                    <div class="inp">
                        <div class=""> <h3>Make this todo private</h3>
                            <p>When a todo is set to private, 
                              it can only be viewed or joined by invitation.</p>

                        </div>
                        <div>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                              </label>
    
                        </div>
                    </div>
                     

                       
                      <input type="submit" class="s" value="Submit">
                    </form>
              </div>
              
            </div>
          
          </div> 
                
</template>
<script>
                  // Get the modal
                  var modal = document.getElementById("myModal");
                  
                  // Get the button that opens the modal
                  var btn = document.getElementById("myBtn");
                  
                  // Get the <span> element that closes the modal
                  var span = document.getElementsByClassName("close")[0];
                  
                  // When the user clicks the button, open the modal 
                  btn.onclick = function() {
                    modal.style.display = "block";
                  }
                  
                  // When the user clicks on <span> (x), close the modal
                  span.onclick = function() {
                    modal.style.display = "none";
                  }
                  
                  // When the user clicks anywhere outside of the modal, close it
                  window.onclick = function(event) {
                    if (event.target == modal) {
                      modal.style.display = "none";
                    }
                  }
                  </script>