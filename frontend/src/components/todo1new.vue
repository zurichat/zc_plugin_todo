<template>
    <div>
    <div class="">
    <div class="nav ">
    <select class="sele" name="pets" id="sel">
<option value=""># <span>Todo-list</span></option>
<option value="dog">Dog</option>
<option value="cat">Cat</option>
<option value="hamster">Hamster</option>
<option value="parrot">Parrot</option>
<option value="spider">Spider</option>
<option value="goldfish">Goldfish</option>
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
          <button class="bu">
             create a new todo
          </button>
       
       </div>
  </div>
    </div>
    <div class="main">
        <div class="empty">
            <p class="p-one">
                 You have no To-dos yet.Click
                  on the button below </p><p class="p-one">to add your first one.
                  To-do list created will appear here.
             </p>
             <button class="b">+ Create a new button</button>
             
        </div>
    </div>
</div>
</div> 
  

</template>