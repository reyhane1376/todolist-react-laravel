import { useState } from "react"
import TodoList from "./TodoList"
import NoWorkResult from "postcss/lib/no-work-result";

export default function Todos () 
{
    const [ todos, setTodos] = useState([
        {
            id : 1,
            title : 'go school',
            status : false
        },
        {
            id : 2,
            title : 'go to gym',
            status : true
        }
    ]);

    const addTodoNewHandler = (event) => {
        if (event.key === 'Enter' && event.target.value !== "") {
            setTodos([
                ...todos,
                {
                    id : 3,
                    title : event.target.value,
                    status : false
                }
            ])

            event.target.value = '';
        }
    }


    const deleteTodo = (todo) => {
        let newTodo = todos.filter( (todoItem) => {
            return todo.id !== todoItem.id
        });


        setTodos(newTodo)
    }

    const toggleTodoStatusHandler = (todo) => {

        let newTodo = todos.map( (todoItem) => {
            if (todo.id == todoItem.id) {
                todoItem.status = ! todoItem.status
            }


            return todoItem;
        })


        setTodos(newTodo);

    }


    return (
        <div className="flex items-center justify-center h-screen">
        <div className="w-full px-4 py-8 mx-auto shadow lg:w-1/3  bg-white">
            <div className="flex items-center mb-6">
                <h1 className="mr-6 text-4xl font-bold text-purple-600"> TO DO APP</h1>
            </div>
            <div className="relative">
                <input type="text" placeholder="What needs to be done today?"
                onKeyDown={addTodoNewHandler}
                className="w-full px-2 py-3 border rounded outline-none border-grey-600" />
            </div>
            <TodoList todos={todos} deleteTodo={deleteTodo} toggleTodoStatusHandler={toggleTodoStatusHandler} />
        </div>
    </div>
    )
}