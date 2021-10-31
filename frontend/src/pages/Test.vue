<template>
  <div class="nav-bar" style="background-color: #FFD43C;" id="top">
        <div class="navbar-brand pl-3" style="font-weight: 500;font-family: 'gilroybold'; font-size:xx-large;">Test</div>
    </div>

    <h1>Get todo</h1>
    <a href="http://todo.zuri.chat/api/v1/user-todo?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7" type="button">Get user todo</a>

    <h1>Get tasks</h1>
    <a href="http://todo.zuri.chat/api/v1/user-todo?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7" type="button">Get task</a>

    <h1>Sidebar</h1>
    <a href="http://todo.zuri.chat/api/v1/sidebar?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7" type="button">Get sidebar</a>

    <h1>Create Todo</h1>
    <form action="http://todo.zuri.chat/api/v1/create" method="POST">
        <label>Title</label>
        <input type="text" name="title">
        <label>Type</label>
        <input type="text" name="type">
        <input type="hidden" name="organisation_id"  value="614679ee1a5607b13c00bcb7">
        <input type="hidden" name="user_id" value="614b453144a9bd81cedc0b25">
        <input type="submit" value="submit"/>
    </form>

</template>

<script>
export default {

};
</script>

<style scoped>
    html {
        scroll-behavior: smooth;
    }

    body {
        color: #5b5b5b;
        font-size: large;
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
        color: #323131;
    }

    .nav-link {
        background-color: #FF8C5F;
        color: #fff;
        margin: 0 5px
    }

    nav {
        background: #FF8C5F;
        padding: 0 15px;
    }

    a {
        color: white;
        text-decoration: none;
    }

    .menu {
        list-style-type: none;
    }

    .logo {
        font-size: 20px;
        padding: 7.5px 10px 7.5px 0;
    }

    .item {
        padding: 10px;
    }

    .item.button {
        padding: 9px 5px;
    }

    .item:not(.button) a:hover,
    .item a:hover::after {
        color: blue;
    }
    /* Mobile menu */

    .menu {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .menu li a {
        display: block;
        padding: 15px 5px;
    }

    .menu li.subitem a {
        padding: 15px;
    }

    .toggle {
        order: 1;
        font-size: 20px;
    }

    .item.button {
        order: 2;
    }

    .item {
        order: 3;
        width: 100%;
        justify-content: center;
        align-items: center;
        display: none;
    }

    .active .item {
        display: block;
    }
    /* Tablet menu */

    @media all and (min-width: 700px) {
        .menu {
            justify-content: center;
        }
        .logo {
            flex: 1;
        }
        .item.button {
            width: auto;
            order: 1;
            display: block;
        }
        .toggle {
            flex: 1;
            text-align: right;
            order: 2;
        }
        /* Button up from tablet screen */
        .menu li.button a {
            padding: 10px 15px;
            margin: 5px 0;
        }
    }
    /* Desktop menu */

    @media all and (min-width: 960px) {
        .menu {
            align-items: flex-start;
            flex-wrap: nowrap;
            background: none;
        }
        .logo {
            order: 0;
        }
        .item {
            order: 1;
            position: relative;
            display: block;
            width: auto;
        }
        .button {
            order: 2;
        }
        .toggle {
            display: none;
        }
        .submenu-active {
            border-radius: 0;
        }
    }

    .controller {
        padding: 5px;
        background-color: #FF8C5F;
        width: 50px;
        float: right;
        position: fixed;
        bottom: 10%;
        right: 10%;
    }
</style>
