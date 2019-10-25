<template>
<div class="container">
	<div class="card">
  			<div class="card-header mb-2">Add New Todo</div>
  			<div class = "card-body">
  				<div class="col-md-5 offset-md-3">
  					
  					<form  @submit.prevent="registerUser">
  						<!-- <h2 class="h3 mb-3 font-weight-normal text-centre">Fill The Form Below To Register</h2> -->
  						<div class="form-group">
  							
  							<input v-model="title" type="text" placeholder = "Enter Todo Title" class ="form-control" name="title" required>
  							
  						</div>
  						<div class="form-group">
  							
  							<textarea class ="form-control" v-model="details" placeholder = "Enter Todo Details" required>
  								
  							</textarea> 
  							
  						</div>
  						<div class="form-group">
  							
  							<input v-model="due_date" type="datetime-local"  placeholder = "Enter Due Date" class ="form-control" name="due_date">
  							
  							
  						</div>
  						
  						<div class="form-group">
  							<button class="btn btn-primary btn-lg btn-block">Add Todo</button>
						</div>
  					</form>
  				</div>
  				
  			</div>
  			
  		</div>
	</div>
</template>		

<style type="text/css" scoped>
	textarea{
		height: 100px;
	}
</style>