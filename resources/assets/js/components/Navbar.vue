<template>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light mb-2 navigation">
		  <router-link class="navbar-brand" v-bind:to='home_url'><img src="/images/todox.jpg" style="width:45px; height: 35px;"></router-link>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		      <li class="nav-item active">
		        <router-link class="nav-link" v-bind:to='home_url'>Home <span class="sr-only">(current)</span></router-link>
		      </li>
		     
		    </ul>
		    <ul v-if = "user !== null || auth ==='logged-in'"  class="navbar-nav ml-auto mt-2 mt-lg-0 right-item">
		    	<!-- <li class="nav-item">
			        <a class="nav-link active">{{user.username}}<span class="sr-only">(current)</span></a>
			     </li> -->
			     <li class="nav-item">
			        <router-link class="nav-link active" to="/todos">My Todos<span class="sr-only">(current)</span></router-link>
			     </li>
			     <li class="nav-item">
			        <a class="nav-link active" @click="logout" href="javascript:;">Logout<span class="sr-only">(current)</span></a>
			     </li>
 			</ul>
		    <ul v-else class="navbar-nav ml-auto mt-2 mt-lg-0 right-item">
			   
		    	<li class="nav-item active">
			        <router-link to='/register' class="nav-link">Register <span class="sr-only">(current)</span></router-link>
		      	</li>
		      	<li class="nav-item active">
		        	<router-link class="nav-link" to='/login'>Login <span class="sr-only">(current)</span></router-link>
		      	</li>
		    </ul>
		    
		    
		  </div>
		</nav>
	</div>
	
</template>

<script type="text/javascript">
	import EventBus from './EventBus'
	export default{
		name:'navbar',
		props:['user'],
		data(){
			return{
				auth:'',
				home_url:''
			}

		},
		methods:{
			logout(){

				
					localStorage.removeItem('userToken');
				   // this.user = null;
				    EventBus.$emit('user','');
				 	this.$router.push({name:"Login"});
				
			   	
			 	//console.log(this.user);
			}
			// ,loggedIn(){
			// 	if(this.user !== null || this.auth =='logged-in'){
					
			// 		this.home_url = "/logi";
			// 	}else{
			// 		this.home_url = "/todos";
			// 	}
			// }
		},
		mounted(){
			//this.loggedIn();
			EventBus.$on('user',status =>{
				this.auth = status;
				console.log(status);
			});
			
		}

	}
	
</script>

<style type="text/css" scoped>
	.navigation{
		background-color: #86a5e4;
		border-radius: 3px;
		opacity: 0.9;
	}

	 .right-item li{
		border:1px solid #000;
		margin-right: 8px;
		border-radius: 3px;
		background-color: #fff;
		color: #86a5e4;
	}
	
</style>