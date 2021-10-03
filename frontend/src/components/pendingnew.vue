<template>
     <div>
        
        <div class="nav ">
                     <select name="pets" id="sel">
                         <option value=""># <span>Todo-list</span></option>
                         <option value="">Dog</option>
                         <option value="">Cat</option>
                         <option value="">Hamster</option>
                         <option value="">Parrot</option>
                         <option value="">Spider</option>
                         <option value="">Goldfish</option>  
                     </select>
         </div>
        <div class="pendfirst">
            <div class="pendfir">
                <div class="">
                    <h3 class="p-pend">Build Temi's landing page</h3>
                    <p class="p-pend">Design ui for a todo plugin</p>
                </div>
                <div class="">
                    <p class="p-pend green"><a href="" class="green">Return to-do list</a></p>
                </div>
            </div>
        </div>
        <div class="pendsec">
            <div class="flex-container">
                <div style="flex-grow: 8">Tasks</div>
                <div style="flex-grow: 1">Add a new task</div>
                <div style="flex-grow: 1">Admin(4)</div>
              </div>

        </div>
        <div class="secondnav">
            <div class="topnav flex space-between">
                    <div class="first">
                        <a class="active" href="#home">pending</a>
                        <a href="#news">Completed</a>
                       
                    </div>
                
                    <div class="second">
                        <button class="bu" id="">
                            create a new task
                        </button>
                        
                   </div>
            </div>
         </div>
         <div class="card">
            <div class="firstcard">
                <div class="">
                    <p>Task 01-Compile user interview questions</p>
                    <p><span class="green">Due tommorrow</span> | <span>show description</span></p>
                </div>
                <div class=""></div>
            </div>
            <div class="secondcard">
                <div class="">
                    <p><img src="img/Rectangle 892.png">
                       <img src="img/Rectangle 894.png">
                       <img src="img/rectangle 896.png"
                       >
                       <span><a href="" class="green">5 comments </a></span>
                       . Last comment 12 hours ago | urgent Hng
                    </p>
                </div>
                <div class="">
                    <button class="bu"  id="myBtn">Mark as done</button>
                </div>
            </div>
         </div>
         <div class="card">
            <div class="firstcard">
                <div class="">
                    <p>Task 01-Compile user interview questions</p>
                    <p><span class="green">Due tommorrow</span> | <span>show description</span></p>
                </div>
                <div class=""></div>
            </div>
            <div class="secondcard">
                <div class="">
                    <p><img src="img/Rectangle 892.png">
                       <img src="img/Rectangle 894.png">
                       <img src="img/rectangle 896.png"
                       >
                       <span><a href="" class="green">5 comments </a></span>
                       . Last comment 12 hours ago | urgent Hng
                    </p>
                </div>
                <div class="">
                    <button class="bu">Mark as done</button>
                </div>
            </div>
         </div>
         <div class="card">
            <div class="firstcard">
                <div class="">
                    <p>Task 01-Compile user interview questions</p>
                    <p><span class="green">Due tommorrow</span> | <span>show description</span></p>
                </div>
                <div class=""></div>
            </div>
            <div class="secondcard">
                <div class="">
                    <p><img src="img/Rectangle 892.png">
                       <img src="img/Rectangle 894.png">
                       <img src="img/rectangle 896.png"
                       >
                       <span><a href="" class="green">5 comments </a></span>
                       . Last comment 12 hours ago | urgent Hng
                    </p>
                </div>
                <div class="">
                    <button class="bu">Mark as done</button>
                </div>
            </div>
         </div>
        </div>
    
    

<!-- The Modal -->


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