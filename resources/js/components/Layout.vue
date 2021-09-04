<template>
<<<<<<< HEAD
    <div id="main_container">
        
        <aside>
              <!-- <Sidebar/>-->
        </aside>
        <main>
             <nav>
                <Navbar/>   
            </nav>
            <div id="content">
                <Main/> 
            </div> 
        </main>
        <footer>
            <Footer/>  
        </footer>
                
                    
            
            
            
    </div>
</template>
<script>
import Sidebar from './Sidebar';
import Navbar from './Navbar';
import Main from './Main';
import Footer from './Footer';
export default {
    name: "Layout",
    components: {
            Sidebar,
            Navbar,
            Main,
            Footer
        },
}
</script>
 <style> 

 #main_container
 {
    height:100%;
}
#main_container{
	
	display:grid;
	grid-template-columns:2% 85%;
	grid-template-rows:min-content auto;
	grid-column-gap:0.5rem;
}
main{
			grid-column-start:2;
			grid-column-end:3;
}
footer{
	grid-column-start:1;
	grid-column-end:3;
}
aside{
     background:white;
     border-style:solid !important;
     
 }  
nav{
     background:#f0f0f0;
}

 footer{
   
     background:#f0f0f0;
 }
#content{
    min-height:1000px;
  
}
aside{
    display:none;
}
@media only screen and (min-width:768px){
    aside{
         display:block;
    }
    #main_container{
	
        display:grid;
        grid-template-columns:30% 65%;
        grid-template-rows:min-content auto;
        grid-column-gap:0.5rem;
    }
}
</style>
=======
  <div id="main_container">
    <main>
      <nav>
        <todo-nav />
      </nav>
      <div id="content">
        <Main />
      </div>
    </main>
    <footer>
      <Footer />
    </footer>
  </div>
</template>
<script>
import Navbar from "./Navbar";
import Main from "./Main";
import Footer from "./Footer";
import TodoNav from './TodoNav.vue';
export default {
  name: "Layout",
  components: {
    Navbar,
    Main,
    Footer,
    TodoNav,
  },
};
</script>
<style>
#main_container {
  height: 100%;
}
#main_container {
  display: grid;
  grid-template-columns: 2% 85%;
  grid-template-rows: min-content auto;
  grid-column-gap: 0.5rem;
}
main {
  grid-column-start: 2;
  grid-column-end: 3;
}
footer {
  grid-column-start: 1;
  grid-column-end: 3;
}
aside {
  background: white;
  border-style: solid !important;
}
nav {
  background: #f0f0f0;
}

footer {
  background: #f0f0f0;
}
#content {
  min-height: 1000px;
}
aside {
  display: none;
}
@media only screen and (min-width: 768px) {
  aside {
    display: block;
  }
  #main_container {
    display: grid;
    grid-template-columns: 30% 65%;
    grid-template-rows: min-content auto;
    grid-column-gap: 0.5rem;
  }
}
</style>
>>>>>>> 27b5eaf0f01851494ee852786caed3c37108a28d
