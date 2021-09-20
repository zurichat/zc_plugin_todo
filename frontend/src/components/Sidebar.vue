<template>
    
                <div><img src="img/zuri.png"/></div>
               <div><img src="img/hng.png"/></div>
                <ul>
                    <li v-for ="(link, index) in lists" :key="index">
                        <i :class="link.icon" ></i>
                             {{link.title}}
                       
                        <ul class="drop">
							<li v-for ="(clink, cindex) in link.child" :key="cindex">
                               <i :class="clink.icon" ></i>
                                 {{clink.title}}     
                            </li>
                        </ul>
                    </li>
                </ul>
    
</template>
<script>
export default {
    name: "Sidebar",
    data(){
        return{
            lists: 
            [
                {
                    title: 'Channel',
                    icon: 'fas fa-grip-lines-vertical',
                    link: '#',
                    child:[
                        { title: 'Announcement',
                          icon: 'fas fa-bullhorn',
                          link: '/channel'
                        },
                        { title: 'Games',
                          icon: 'fas fa-dice-d20',
                          link: '/channel'
                        },
                        { title: 'Developer',
                          icon: 'fas fa-layer-group',
                          link: '/channel'
                        } 
                    ]
                },
                {
                    title: 'Cheeseboard',
                    icon: 'fas fa-chess-rook',
                    link: '#',   
                },
                {
                    title: 'Whiteboard',
                    icon: 'fas fa-chess-board',
                    link: '#',   
                },
                 {
                    title: 'Company Holiday Calender',
                    icon: 'fas fa-calendar-check',
                    link: '#',   
                },
                 {
                    title: 'Notice Board Plugin',
                    icon: 'fas fa-barcode',
                    link: '#',   
                },
                {
                    title: 'Channel Plugin',
                    icon: 'fas fa-bullseye',
                    link: '#',   
                },
                {
                    title: 'Zuri Todo App',
                    icon: 'fas fa-mobile-alt',
                    link: '#',   
                },
                 {
                    title: 'Goals Zuri App',
                    icon: 'fas fa-mobile',
                    link: '#',   
                },
                 {
                    title: 'Trackers Zuri App',
                    icon: 'fas fa-thumbtack',
                    link: '#',   
                },
                 {
                    title: 'Sales Zuri App',
                    icon: 'fas fa-tablet',
                    link: '#',   
                },
                {
                    title: 'Messages',
                    icon: 'fas fa-envelope',
                    link: '#',
                    child:[
                        { title: 'Okom',
                          icon: 'fas fa-user',
                          link: '/channel'
                        },
                        { title: 'Emmanuel',
                          icon: 'fas fa-user',
                          link: '/channel'
                        },
                        { title: 'Team Kant',
                          icon: 'fas fa-user',
                          link: '/channel'
                        } 
                    ]
                }
                
            ]
        }
    }
}
</script>
<style scoped>

.fas{
    color: Mediumslateblue
}

ul li {
	color:black;
	padding: 8px 24px;
	margin:3px 0;
	
}
ul li i{
	margin-right:8px;
	color:#555;
}

li ul li {
   
	
	color:green;
    display:block;
    margin:10px 0;

}
img{
    width:100%
}
</style>