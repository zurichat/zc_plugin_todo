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
        <div class="third">

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content ">
    <div class="heading">
      <span class="close">&times;</span>
        <h1>create a new task</h1>

    </div>
    <div class="bodyy">
        <p class="p-two">A sub-task makes it easier to break down
            other ambiguous tabs into smaller chunks
        </p>
    </div>
    <div class="form">
        <form action="/action_page.php">
            <label for="fname"> Name</label>
            <input  class="in" type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="lname" class="formspace">Description (optional)</label>
            <input class="in" type="text" id="lname" name="lastname" placeholder="Your last name..">

            <label for="lname" class="formspace">Assignees</label>
            <select class="in" id="country" name="country">
                <option value="australia">Chidinma<span><img src="img/rectangle892.png"> </span></option>
                <option value="canada">Alex</option>
                <option value="usa">jordan</option>
              </select>

            <label for="country" class="formspace">Admin</label>
            <select class="in" id="country" name="country">
              <option value="australia">Charles</option>
              <option value="canada">Uche</option>
              <option value="usa">Merlin</option>
            </select>

            <input type="submit" class="sub" value="Submit">
          </form>
    </div>

  </div>

</div>
        </div>
    </div>
</template>
<script>
// Get the modal
const modal = document.getElementById('myModal');

// Get the button that opens the modal
const btn = document.getElementById('myBtn');

// Get the <span> element that closes the modal
const span = document.getElementsByClassName('close')[0];

// When the user clicks the button, open the modal
btn.onclick = function () {
  modal.style.display = 'block';
};

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = 'none';
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
};
</script>
