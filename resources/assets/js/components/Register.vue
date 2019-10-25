<template>
	<div class="container">
		<div class="card">
  			<div class="card-header mb-2">Register</div>
  			<div class = "card-body">
  				<div class="col-md-5 offset-md-3">
  					
  					<form  @submit.prevent="registerUser">
  						<!-- <h2 class="h3 mb-3 font-weight-normal text-centre">Fill The Form Below To Register</h2> -->
  						<div class="form-group">
  							
  							<input v-model="lastname" type="text" placeholder = "Enter Last Name" class ="form-control" name="name" required>
  							
  						</div>
  						<div class="form-group">
  							
  							<input v-model="firstname" type="text"  placeholder = "Enter First Name" class ="form-control" name="firstname" required>
  							
  						</div>
  						<div class="form-group">
  							
  							<input v-model="username" type="text"  placeholder = "Enter Username" class ="form-control" name="username" required>
  							
  							
  						</div>
  						<div class="form-group">
  							
  							<input v-model="email" type="email"  placeholder = "Enter Email" class ="form-control" name="email" required>
  							
  						</div>
  						<div class="form-group">
  							
  							<input v-model="phone_number" type="number" placeholder = "Enter Phone Number" class ="form-control" name="phone_number" required>
  							
  						</div>
  						<div class="form-group">
  							
  							<input v-model="password" placeholder = "Enter Password" type="password" class ="form-control" name="password" required>
  							
  						</div>
  						<div class="form-group">
  							
  							<input v-model="confirm_password" placeholder = "Confirm Password" type="password" class ="form-control" name="confirm_password" required>
  							
  						</div>
  						<div class="form-group">
  							<button class="btn btn-primary btn-lg btn-block">Register</button>
						</div>
  					</form>
  				</div>
  				
  			</div>
  			
  		</div>
	</div>
</template>		

<script type="text/javascript">
	import EventBus from './EventBus'
	export default{
		name:'register',
		methods:{
			registerUser(){
				this.errors=[];
				if(this.password !== this.confirm_password){
					this.errors.push("Passwords does not match");
					toast.fire({
							  type: 'success',
							  title: 'Passwords does not match'
							});
				}

				if(!this.errors.length){
					const creds = {
						firstname:this.firstname,
						lastname:this.lastname,
						email:this.email,
						username:this.username,
						password:this.password,
						phone_number:this.phone_number
					}

					axios.post('api/register',creds)
					.then((res) =>{
							localStorage.setItem('userToken',res.data.token);
							console.log(res);
							this.firstname = '';
							this.lastname='';
							this.email='';
							this.username='';
							this.password='';
							this.confirm_password='';
							this.phone_number='';
							toast.fire({
							  type: 'success',
							  title: 'Registered successfully'
							});

							EventBus.$emit('user','logged-in');
							this.$router.push({name:'Todos'});
						}

					)
					.catch((error)=>{
						
						console.log(error.response.data.error);
					})

				}
				
			}
		},
		data(){
			return{
				firstname:'',
				lastname:'',
				username:'',
				email:'',
				password:'',
				confirm_password:'',
				phone_number:'',
				errors:[]
			}
		}
	}

</script>	