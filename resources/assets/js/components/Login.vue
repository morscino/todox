<template>
	<div class="container">
		<div class="card">
  			<div class="card-header">Login</div>
  			<div class = "card-body">
  				<div class="col-md-5 offset-md-3">
  					
  					<form @submit.prevent="login">
  						
  						<div class="form-group">
  							<label>Username</label>
  							<input type="text" v-model="username"class ="form-control" name="username">
  							
  						</div>
  						
  						<div class="form-group">
  							<label>Password</label>
  							<input type="password" v-model = "password" class ="form-control" name="password">
  							
  						</div>
  						<div class="form-group">
  							<button class="btn btn-primary btn-lg btn-block">Login</button>
						</div>
  					</form>
  				</div>
  			
  			
  			</div>
		</div>
	</div>
</template>	

<script type="text/javascript">
	import EventBus from './EventBus';
	export default{
		name:'login',
		props:['app'],
		data(){
			return{
				username:'',
				password:''
			}
		},
		methods:{
			login(){
				const creds = {
					username : this.username,
					password : this.password
				}

				axios.post('/api/login',creds).then((response)=>{
						console.log(response.data.token);
						localStorage.setItem('userToken',response.data.token);

						this.username = '';
						this.password = '';

						toast.fire({
						  type: 'success',
						  title: 'Signed in successfully'
						});
						this.$router.push({name:"Todos"});
						EventBus.$emit('user','logged-in');
						
					}

				).catch((error)=>{
					console.log(error.response.data.error);
					toast.fire({
						  type: 'success',
						  title: 'Not Successfully Signed in '
						});
				})
				
				
				
				
			}
		}
	}

</script>	

<style type="text/css" scoped>
	
</style>