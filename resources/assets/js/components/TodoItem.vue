<template>
	<div class="todoItem mb-1 row">

		<td class="col-md-1">
			<input type="checkbox">
		</td>
		<td class="col-md-3">
			<div class="todo-title">{{todo.title}}</div>
			
		</td>
		<td class="col-md-4">
			<div class="todo-details">{{todo.details}}</div>
		</td>
		<td class="col-md-3">
			<img data-toggle="modal" v-bind:data-target="idModal" src="/images/edit.png">
			<img @click="deleteTodo(todo.id)" src="/images/delete.png">
		</td>
		<table class="date-table">
			<tbody>
				<tr>
					<td>
						<div class="created mt-2">Created: <span class="time">{{todo.created_at | moment("from","now",true)}} ago</span></div>
					</td>
					<td>
						<div class="created mt-2">Updated: <span class="time">{{todo.updated_at | moment("from","now",true)}} ago</span></div>
					</td>
					<td>
						<div class="created mt-2">Due: <span class="time">Coming soon</span></div>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- Modal -->
		<div class="modal fade" v-bind:id="idData" tabindex="-1" role="dialog" aria-labelledby="editTodoModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="editTodoModalLabel_todo.id">Edit {{todo.title}}</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		       		<form  @submit.prevent="editTodo(todo.id)">
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
					        <button type="submit" class="btn btn-primary">Save Changes</button>
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
	export default{
		name:"TodoItem",
		props:['todo'],
		data(){
			return{
				idData:"editTodoModal_"+this.todo.id,
				idModal:"#editTodoModal_"+this.todo.id,
				title:this.todo.title,
				details:this.todo.details,
				due_date:'',
				token:localStorage.getItem('userToken')
			}
		},
		methods:{
			editTodo(id){
				const todoData = {
					title:this.title,
					details:this.details
				}
				axios.put('api/todo/edit/'+id,todoData,{
						headers:{
							Authorization:`Bearer ${this.token}`
						}
					}).then((response)=>{
						EventBus.$emit('edit-todo',id);
						toast.fire({
						  type: 'success',
						  title: 'Todo Updated Successfully'
						});

						this.title="";
						this.details="";
						
					}).catch((error)=>{
						toast.fire({
						  type: 'success',
						  title: 'Todo not Edited Successfully'
						});
					})
					$(this.idModal).modal('hide');
				console.log(id);
			},
			deleteTodo(id){
				if(confirm('Are you sure you want to delete Todo?')){
					axios.delete('api/todo/delete/'+id,{
						headers:{
							Authorization:`Bearer ${this.token}`
						}
					}).then((response)=>{
						EventBus.$emit('del-todo',id);
						toast.fire({
						  type: 'success',
						  title: 'Todo Deleted Successfully'
						});
						
					}).catch((error)=>{
						toast.fire({
						  type: 'success',
						  title: 'Todo not Deleted Successfully'
						});
					})

				}
			}
		}
	}
</script>

<style type="text/css" scoped>
	.todoItem {
		background: #f4f4f4;
		padding: 10px 10px 5px 10px;
		border-bottom: 1px #ccc dotted;
		border-radius: 3px;
	}

	.created{
		font-size: 12px;
	}
	.time{
		color: green;
	}
	tbody tr{
		background-color: #f4f4f4 !important;
	}

	.date-table td{
		border-top: none !important;
	}
	.todo-title,.todo-details{
		border-right: 1px solid #ccc;
		padding-right: 10px;
	}
	.row{
		margin-right: 4px;
		margin-left: 4px;
	}
	td img{
		cursor: pointer;
	}
</style>