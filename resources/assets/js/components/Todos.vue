<template>
	<div class="container">
		<div class="card">
			<div class="col-md-10 offset-md-1">
				<div class="card-header mb-1 mt-2">My Todos</div>
				<div class=" todos-top">
					<ul class="ml-3 ">
						<li class="mr-2"><img src="/images/add.png" data-toggle="modal" data-target="#addTodoModal"></li>
						<li data-toggle="modal" data-target="#addTodoModal">Add todo</li>
					</ul>
					
				</div>
				<table class="table ">
					<tbody>
						<tr v-for="todo in todos" v-bind:key="todo.id" v-on:del-todo="deleteTodo">
							<TodoItem v-bind:todo="todo" v-on:del-todo="deleteTodo"/>
						</tr>
						
					</tbody>
					
				</table>		
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="addTodoModal" tabindex="-1" role="dialog" aria-labelledby="addTodoModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="addTodoModalLabel">Add New Todo</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		       		<form  @submit.prevent="createTodo">
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
  						<div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Add Todo</button>
					      </div>
					</form>
		      </div>
		      
		    </div>
		  </div>
		</div>
		
	</div>

</template>


<script type="text/javascript">
	import EventBus from "./EventBus";
	import TodoItem from './TodoItem.vue'; 

	export default{
		name:"Todos",
		components:{
			TodoItem
		},
		data(){
			return{
				todos:[],
				title:'',
				details:'',
				due_date:'',
				token:localStorage.getItem('userToken')
			}
		},
		methods:{
			init(){
				const token = localStorage.getItem('userToken');
				axios.get('api/todos',{
					headers:{
						Authorization:`Bearer ${token}`
					}
				})
				.then((response)=>{
					this.todos = response.data.todos;
					console.log(response.data.todos);
				}).catch((error)=>{
					console.log(error.response.data.error);
				})
			},
			createTodo(){
				
				const todoData = {
					title:this.title,
					details:this.details
				}

				axios.post('api/todo/create',todoData,{
					headers:{
						Authorization:`Bearer ${this.token}`
					}
				}).then((response)=>{
					console.log(response.data);
					toast.fire({
						  type: 'success',
						  title: 'Todo Created Successfully'
						});
					//this.todos.push(response.data.todo);
					this.init();
					
					this.title="";
					this.details="";

					//this.$router({name:"Todos"});
				console.log('working');
				}).catch((error)=>{

				})
				//close modal
				$('#addTodoModal').modal('hide');
				
			},
			deleteTodo(id){
				console.log(id);
				this.init();
			}
		},
		created(){
			this.init();
			EventBus.$on('del-todo',status =>{
				this.deleteTodo(status);
				console.log(status);
			});

			EventBus.$on('edit-todo',status =>{
				this.init();
				console.log(status);
			});
		}
		// mounted(){
		// 	EventBus.$on('user',status =>{
		// 		this.auth = status;
		// 		console.log(status);
		// 	});

		//}

	}
</script>

<style type="text/css" scoped>
	ul{
		list-style-type: none;
	}

	ul li{
		float: left;
		cursor: pointer;
	}
	.todos-top{
		/*margin-bottom: 2px;*/
	}
</style>