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
         <div class="secondnav navsec">
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

          <div class="card-assigning">
              <div class="">
                  <p>Build Temi's landing page</p>
                  <h4>Design the UI for a todo plugin</h4>
              </div>
              <div class="mar"> :</div>

              <progress class="pro" id="file" value="32" max="100"> 32% </progress>

            <label class="main">GeeksforGeeks
                <input type="checkbox" checked="checked">
                <span class="geekmark"></span>
                <span>5/10 (50% Completed)</span>
            </label>
            <p>sept 18,2021 . <span>20 days left</span></p>
            <div class="sh">
                  <div><p><img src="img/Rectangle 892.png">
                          <img src="img/Rectangle 894.png">
                          <img src="img/Rectangle 896.png">300</p></div>
                  <div>
                      <a class="green" href="Viewtasks">Viewtasks</a>
                  </div>
            </div>
          </div>
        </div>
</template>
