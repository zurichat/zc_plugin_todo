<template>
    <div class="ctn">
        <div class="container">
            <input
                type="text"
                placeholder="Search here"
            >
            <div class="search-filter-icon">
                <img src="./img/icon-filter-8.svg" alt="search-filter-icon">
            </div>
            <div class="search-filter-modal-box">
                <a href="">Filter by assigned task</a>
                <a href="">Filter by user</a>
                <a href="">Filter by tags</a>
            </div>
        </div>
    </div>
    
</template>

<script>
export default {
    name: "SearchFilter",
    methods: {
        toggleSearchFilter(){
            let searchFilterModal = document.querySelector('.search-filter-icon');
            let modalDialog = document.querySelector('.search-filter-modal-box');

            searchFilterModal.addEventListener('click', function(){
            modalDialog.classList.toggle('show-modal');
            console.log('akay')
            });
        },
        mounted() {
            this.toggleSearchFilter()
        }
    }
}
</script>

<style scoped>
    .ctn{
        display: flex;
        justify-content: flex-end;
    }
    .container{
    margin: 1rem;
    width: 23rem;
    display: flex;
    align-items: center;
    height: 50px;
    }

    input{
        width:23rem;
        height:40px;
        border-radius: 3px;
        background: rgba(255, 255, 255, 0.4);
        border: 0.8px solid rgba(153, 153, 153, 0.2);
        padding: 0 40px;
        position: relative;
        outline: none;
    }

    .search-filter-icon{
        width: 14px;
        max-width: 14px;
        height: 14px;
        position: absolute;
        left: 91%;
        cursor: pointer;
    }

    .search-filter-modal-box{
        position: absolute;
        width: 170px;
        height: 150px;
        left: 83%;
        top: 5rem;
        z-index: 2;
        background: #FFFFFF;
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        color: #000;
        padding: 1rem;
        display: none;
        animation-name: modalopen;
        animation-duration: 0.3s;
    }

    .search-filter-modal-box a {
        text-decoration: none;
        color: #000;
        display: block;
        margin: 0 auto 1rem;
        font-size: 13px;
    }

    .show-modal{
        display: block;
    }

    @keyframes modalopen{
        from{opacity: 0;}
        to {opacity: 1;}
    }
</style>