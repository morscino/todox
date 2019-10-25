import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Todos from './components/Todos.vue';
import AddTodo from './components/AddTodo.vue';
import EditTodo from './components/EditTodo.vue';

const routes = [
	{path: '/', component: Home,name:'Home'},
	{path:'/register',component:Register,name:'Register'},
	{path:'/login',component:Login,name:'Login'},
	{path:'/todos',component:Todos,name:'Todos'},
	{path:'/add-todo',component:AddTodo,name:'AddTodo'},
	{path:'/edit-todo',component:EditTodo,name:'EditTodo'}
];

export default routes