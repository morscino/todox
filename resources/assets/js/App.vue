<template>
	<div class="application">
		<navbar v-bind:user="user"></navbar>
		<router-view v-bind:user="user"/>
	</div>
	
</template>

<script type="text/javascript">
import Navbar from './components/Navbar.vue'
	export default {

		name:'app',
		components:{
			Navbar
		},
		methods:{
			init(){
				
				const token = localStorage.getItem('userToken');
				axios.get('api/index',{
					headers:{
						
						Authorization:`Bearer ${token}`
					}
				}).then((res) =>{
						//console.log(res.data);
						this.user = res.data.user;
					}

				).catch((err) =>{
						console.log(err);
					}

				)
			}

		},
		created(){
			this.init();
		},
		data(){
			return {
				user:""
			}
		}

	}
	
</script>

<style type="text/css">

	/*Font family*/
@font-face {
  font-family: 'poppins';
  font-style: normal;
  font-weight: 400;
  src:	url('/fonts/poppins.ttf') format('truetype'), 
		url('/fonts/poppins.woff') format('woff');
}

@font-face {
  font-family: 'Rubik';
  font-style: normal;
  font-weight: 400;
  src:	url('/fonts/Rubik.ttf') format('truetype'), 
		url('/fonts/Rubik.woff') format('woff');
}
	* {
		box-sizing: border-box;
		margin:0;
		padding: 0;

	}

	.card{
		opacity: 0.87;
	}

	a{
		text-decoration: none;
		text-decoration-style: none;
	}
	body{
	line-height: 1.4;
		font-family: 'poppins' !important;
	width: 100%;
	min-height: 100%;
	height: auto;
	overflow: auto;
	background-image:url(/images/background.jpg);
	/*padding-bottom: 300px;*/
	background-size: cover;
	background-repeat:no-repeat;
}
</style>