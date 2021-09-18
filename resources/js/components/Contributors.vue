<template>    
    <div class="collaborators-container">
        <div class="collaborators-functionality">
            <a href="#" @click="closeModal()" class="cancel">&#x2715;</a>
            <div class="container-header">Collaborators</div>
            <div class="search-bar-container">
                <i class="fa fa-search" aria-hidden="true"></i> 
                <input type="text"  id="" placeholder="Find collaborators">
            </div>
            <a href="#" @click="addCollaborator()" class="add-user">
                <i class="fas fa-user-plus"></i> Add People
            </a>
        </div>
        <div class="user-profile-container">
            <!--  DUMMY ONLINE PROFILE  -->
            <div class="user-profile">
                <div class="user-profile-image">
                    <img src="" alt="">
                </div>
                <div class="user-profile-info">
                    <h5 class="name"> Okey
                        <span class="status active"></span>
                        <span class="full-name">Okechukwu Nwoko</span>
                    </h5>
                    <h5 class="position">Product Design Lead, Team Kant</h5>
                </div>
            </div>
            <!--  DUMMY OFFLINE PROFILE  -->
            <div class="user-profile">
                <div class="user-profile-image">
                    <img src="" alt="">
                </div>
                <div class="user-profile-info">
                    <h5 class="name"> Okey
                        <span class="status active"></span>
                        <span class="full-name">Okechukwu Nwoko</span>
                    </h5>
                    <h5 class="position">Product Design Lead, Team Kant</h5>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Collaborators',
    methods: {
        closeModal() {
            
        },
        addCollaborator(){

        },
    },
}
</script>

<style scoped>
    *, *::after, *::before{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    }

    .collaborators-container{
        margin: 20px 20px 0 auto;
        width: 377px;
        height: 478px;
        box-shadow: 5px 10px 15px rgba(0, 0, 0, .25);
        font-family: 'Lato', sans-serif;
        font-weight: 700;
        overflow-y: scroll;
        position: relative;
    }

    .collaborators-functionality{
        background-color: #fff;
        width: 377px;
        height: auto;
        padding: 20px 30px 0 30px;
        position: fixed;
    }

    .cancel{
        display: block;
        text-align: right;
        margin-bottom: 10px;
        text-decoration: none;
        color: #000;
        font-size: 20px;
        font-weight: 700;
    }

    .container-header{
        font-size: 30px;
        margin-bottom: 30px;
    }

    .search-bar-container{
        width: 100%;
        padding: 10px;
        color: #959595;
        margin-bottom: 30px;
        box-shadow: 5px 10px 15px rgba(0, 0, 0, .25);
    }

    .search-bar-container i{
        margin-right: 15px;
    }

    .search-bar-container input{
        border: none;
        font-size: 15px;
        font-weight: 700;
        width: 85%;
    }

    .search-bar-container input:active,
    .search-bar-container input:focus,
    .search-bar-container input:visited{
        outline: none;
    }

    .add-user{
        display: block;
        text-decoration: none;
        color: #000;
        margin-bottom: 30px;
    }

    .add-user i{
        margin-right: 15px;
    }

    .user-profile-container{
        display: flex;
        flex-direction: column;
        padding: 0 30px 20px 30px;
        width: auto;
        height: auto;
        margin-top: 250px;
    }

    .user-profile{
        width: 100%;
        height: 40px;
        display: flex;
        margin-bottom: 20px;
    }

    .user-profile-image{
        width: 45px;
        height: auto;
        border-radius: 10px;
        background-color: blue;
        margin-right: 10px;
    }

    .user-profile-image img{
        object-fit: contain;
        object-position: center;
        -o-object-fit: contain;
        -o-object-position: center;
    }

    .user-profile-info{
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        width: 100%;
        height: auto;
        font-weight: 700;
    }

    .name{
        display: flex;

    }

    .username{
        display: inline;
    }

    .status{
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 0 10px;
        margin-top: 4px;
    }

    .active{
        background-color: #00b87c;
    }

    .inactive{
        border: 1px solid #959595;
    }

    .full-name{
        display: inline;
        color: #959595;
    }
</style>