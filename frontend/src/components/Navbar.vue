<template>
    <nav id="first_section">
        <span id="menu">
            <i class="fas fa-bars fas_color"></i>
        </span>
        <div id="first">
            <span id="second">
                <i class="fas fa-search fas_color"></i>
            </span>
            <input v-model="search" type="text" class="form-control" placeholder="Search here" />
            <span id="third">
                <i class="fas fa-binoculars fas_color"></i>
            </span>
        </div>
        <span id="fourth"><i class="fas fa-cog fas_color"></i> </span>
        <div class="dropdown">
            <span class="dropdown-toggle" id="fifth" data-bs-toggle="dropdown">
                <img
                    src="./img/passport.jpg"
                    width="23"
                    height="23"
                    class="rounded-circle"
                />
            </span>
            <ul class="dropdown-menu">
                <li>
                    <div class="status">
                        <img
                            id="status"
                            src="./img/passport.jpg"
                            width="30"
                            height="30"
                            class="rounded-circle"
                        />
                        <span>Emma </span>
                        <span
                            ><small
                                ><i class="fas fa-circle offline"></i
                                >Active</small
                            ></span
                        >
                    </div>
                </li>
                <div id="input">
                    <input type="text" class="form-control" />
                </div>
                <li><a class="dropdown-item" href="#">Set Status</a></li>
                <li>
                    <a class="dropdown-item" href="#">Set Yourself As Away</a>
                </li>
                <li class="arrow">
                    <a class="dropdown-item" href="#">Pause Notification</a>
                </li>
                <hr />
                <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                <li><a class="dropdown-item" href="#">View Profile</a></li>
                <li><a class="dropdown-item" href="#">Preference</a></li>
                <hr />
                <li><a class="dropdown-item" href="#">Sign Out</a></li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    name: "Navbar",
    data() {
        return {
            todos:['set up repo for new start-up','learn graphql'],
            search:''
        };
    },
    
    computed:{
        filteredTodo(){
             return this.todos.filter(todo=>{
                 return todo.toLowerCase().includes(this.search.toLowerCase());
             })
        }
    }
};
</script>
<style scoped>
.fas_color {
    color: Mediumslateblue;
}
.offline {
    color: green;
    font-size: 10px;
}

.dropdown-toggle::after {
    display: none !important;
}
#first_section {
    display: flex;
    justify-content: flex-end;
    box-sizing: border-box;
    padding-top: 1em;
    padding-bottom: 1em;
}
#first {
    position: relative;
    margin-right: 1em;
}
#fourth,
#fifth {
    display: block;

    margin-top: 1em;
    margin-left: 1em;
}
#first span {
    position: absolute;
    top: 30%;
    z-index: 100;
    padding: 0em 1em 0em 1em;
}
#second {
    left: 0px;
}
#third {
    right: 0px;
}
#first input[type="text"] {
    width: 250px;
    padding: 12px 2em;
    margin: 8px 0;

    box-sizing: border-box;
}
#status {
    float: left;
    margin-left: 10px;
    margin-right: 15px;
}
.status span {
    display: block;
    width: 100%;
    height: 20px;
    padding-left: 2em;
}
#input {
    width: 300px;
    padding: 1em;
}
#input input {
    width: 90%;
    margin: 0 auto;
}
#input input:hover {
    border: 1px solid red;
}
.dropdown-menu a:hover {
    background: rgb(105, 128, 255);
}
.arrow {
    position: relative;
}
ul li.arrow:before {
    content: "\203A";
    position: absolute;
    right: 4px;
    font-size: 1.2em;
    top: 5px;
    font-weight: bold;
}
#menu {
    padding: 1em;
    position: absolute;
    left: 1em;
}
@media only screen and (min-width: 768px) {
    #first input[type="text"] {
        width: 350px;
    }
}
</style>
